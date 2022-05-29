<?php

namespace App\Controller;

use App\Entity\Noticia;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\NoticiaRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


/**
 * @Route("/admin/user", name="app_user")
 */
class AdminUserController extends AbstractController {
    /**
     * @Route("/", name="_lst")
     */
    public function index(Request $req, UserRepository $repo): Response {
        $pag = $req->query->get("pag", 1);
        $results = $repo->findAllPaginated($pag);
        
        if($pag <1 || $pag > $results["maxPages"]) {
            $this->addFlash("danger", "No existe la página a la que intenta acceder");
            return $this->redirectToRoute("app_user_lst");
        }

        return $this->render('user/index.html.twig', [
            'maxPages' => $results["maxPages"],
            'items' => $results["paginator"],
            'pag' => $pag
        ]);
    }

    /**
     * @Route("/new", name="_new")
     * @Route("/edit/{id}", name="_edit")
     */
    public function edit($id=null, Request $req, UserRepository $repo, UserPasswordHasherInterface $passwordEncoder): Response {
        $item = new User();
        if($id!=null) {
            $item = $repo->find($id);
            if($item==null) {
                $this->addFlash("danger", "No existe el usuario que se quiere editar");
                return $this->redirectToRoute("app_user_lst");
            }
        }
        
        $form = $this->createForm(UserType::class, $item);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){

            $password = $passwordEncoder->hashPassword($item, $item->getPassword());
            $item->setPassword($password);


            $repo->add($item, true);
            $this->addFlash("success", "Datos guardados con éxito");
            return $this->redirectToRoute("app_user_lst");
        }

        return $this->render('user/index.html.twig', [
            "myForm" => $form->createView()
        ]);
    }


    /**
     * @Route("/delete/{id}", name="_delete")
     */
    public function delete($id, Request $req, UserRepository $repo): Response {
        $item = new User();
        if($id!=null) {
            $item = $repo->find($id);
            if($item==null) {
                $this->addFlash("danger", "No existe el usuario que se quiere borrar");
                return $this->redirectToRoute("app_user_lst");
            }

            $repo->remove($item, true);
            $this->addFlash("success", "Se ha borrado el elemento");
            return $this->redirectToRoute("app_user_lst");
        }
    }
}
