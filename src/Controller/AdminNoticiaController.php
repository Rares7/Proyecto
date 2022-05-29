<?php

namespace App\Controller;

use App\Entity\Noticia;
use App\Form\Type\NoticiaType;
use App\Repository\NoticiaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/admin/noticia", name="app_noticia")
 */
class AdminNoticiaController extends AbstractController {
    /**
     * @Route("/", name="_lst")
     */
    public function index(Request $req, NoticiaRepository $repo): Response {
        $pag = $req->query->get("pag", 1);
        $results = $repo->findAllPaginated($pag);
        
        if($pag <1 || $pag > $results["maxPages"]) {
            $this->addFlash("danger", "No existe la página a la que intenta acceder");
            return $this->redirectToRoute("app_noticia_lst");
        }

        return $this->render('noticia/index.html.twig', [
            'maxPages' => $results["maxPages"],
            'items' => $results["paginator"],
            'pag' => $pag
        ]);
    }

    /**
     * @Route("/new", name="_new")
     * @Route("/edit/{id}", name="_edit")
     */
    public function edit($id=null, Request $req, NoticiaRepository $repo, SluggerInterface $slugger): Response {
        $item = new Noticia();
        if($id!=null) {
            $item = $repo->find($id);
            if($item==null) {
                $this->addFlash("danger", "No existe la noticia que se quiere editar");
                return $this->redirectToRoute("app_noticia_lst");
            }
        }
        
        $form = $this->createForm(NoticiaType::class, $item);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $imageUploaded = $form->get('imagen')->getData();
            
            if ($imageUploaded) {
                $originalFilename = pathinfo($imageUploaded->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageUploaded->guessExtension();
                try {
                    $mes = date('n');
                    $imageUploaded->move("uploads/$mes/", $newFilename);
                    $rutaImagen = "uploads/$mes/$newFilename";
                    $item->setRutaImagen($rutaImagen);
                } catch (FileException $e) { }
            }

            $repo->add($item, true);
            $this->addFlash("success", "Datos guardados con éxito");
            return $this->redirectToRoute("app_noticia_lst");
        }

        return $this->render('noticia/index.html.twig', [
            "myForm" => $form->createView()
        ]);
    }


    /**
     * @Route("/delete/{id}", name="_delete")
     */
    public function delete($id, Request $req, NoticiaRepository $repo): Response {
        $item = new Noticia();
        if($id!=null) {
            $item = $repo->find($id);
            if($item==null) {
                $this->addFlash("danger", "No existe la noticia que se quiere borrar");
                return $this->redirectToRoute("app_noticia_lst");
            }

            $repo->remove($item, true);
            $this->addFlash("success", "Se ha borrado el elemento");
            return $this->redirectToRoute("app_noticia_lst");
        }
    }
}
