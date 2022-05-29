<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Noticia;
use App\Repository\NoticiaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class NoticiaController extends AbstractController {
    /**
     * @Route("/noticia", name="app_noticia")
     */
    public function index(EntityManagerInterface $em, ValidatorInterface $validator): Response {
        // $em = $this->getDoctrine()->getManager();

        $noticia = new Noticia();
        $noticia->setTitulo("Noticia 1");
        $noticia->setDescripcion("asdf asd fasdfasdf asdf");
        $noticia->setAutor("Toni");

        $errores = $validator->validate($noticia);

        $em->persist($noticia);
        $em->flush();

        return $this->render('noticia/index.html.twig', [
            'controller_name' => 'NoticiaController',
            'datos_url' => ["dato1"=> "valor 1"]
        ]);
    }

    /**
     * @Route("/noticia/show/{id}", name="app_noticia_show")
     */
    public function show($id, NoticiaRepository $repo) {
        $noticia = $repo->find($id);
        //print_r($noticia);
        
        return $this->json(array("titulo" => $noticia->getTitulo()));
    }

    /**
     * @Route("/noticia/showByTitle/{titulo}", name="app_noticia_show_title")
     */
    public function showByTitle($titulo, NoticiaRepository $repo) {
        $noticias = $repo->findBy(array("titulo"=>$titulo));
        print_r($noticias);
        
        $res = array();
        foreach($noticias as $noticia) {
            $res[] = $noticia->getId();
        }

        return $this->json($res);
    }
}
