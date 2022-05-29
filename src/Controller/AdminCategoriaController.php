<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\Type\CategoriaType;
use App\Repository\CategoriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categoria", name="app_categoria")
 */
class AdminCategoriaController extends AbstractController {
    /**
     * @Route("/", name="_lst")
     */
    public function index(Request $req, CategoriaRepository $repo): Response {
        $pag = $req->query->get("pag", 1);
        $results = $repo->findAllPaginated($pag);
        
        if($pag <1 || $pag > $results["maxPages"]) {
            $this->addFlash("danger", "No existe la página a la que intenta acceder");
            return $this->redirectToRoute("app_categoria_lst");
        }

        return $this->render('categoria/index.html.twig', [
            'maxPages' => $results["maxPages"],
            'items' => $results["paginator"],
            'pag' => $pag
        ]);
    }

    /**
     * @Route("/new", name="_new")
     * @Route("/edit/{id}", name="_edit")
     */
    public function edit($id=null, Request $req, CategoriaRepository $repo): Response {
        $item = new Categoria();
        
        //si $id es distinto de null es que estoy intentando editar
        if($id!=null) {
            //Busco la categoría que tenga ese id
            $item = $repo->find($id);
            //Si es null quiere decir que no existe categoría con ese id
            if($item==null) {
                $this->addFlash("danger", "No existe la categoria que se quiere editar");
                return $this->redirectToRoute("app_categoria_lst");
            }
        }
        
        $form = $this->createForm(CategoriaType::class, $item);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $repo->add($item, true);

            $this->addFlash("success", "Datos guardados con éxito");
            return $this->redirectToRoute("app_categoria_lst");
        }

        return $this->render('categoria/index.html.twig', [
            "myForm" => $form->createView()
        ]);
    }


    /**
     * @Route("/delete/{id}", name="_delete")
     */
    public function delete($id, Request $req, CategoriaRepository $repo): Response {
        $item = new Categoria();
        if($id!=null) {
            $item = $repo->find($id);
            if($item==null) {
                $this->addFlash("danger", "No existe la categoria que se quiere borrar");
                return $this->redirectToRoute("app_categoria_lst");
            }

            //TODO comprobar si la categoria tiene noticias asociadas para no permitir el borrado

            $repo->remove($item, true);
            $this->addFlash("success", "Se ha borrado el elemento");
            return $this->redirectToRoute("app_categoria_lst");
        }
    }
}
