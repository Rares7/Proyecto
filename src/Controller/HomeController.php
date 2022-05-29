<?php

namespace App\Controller;

use App\Entity\FiltrosPortada;
use App\Form\Type\FiltroPortadaType;
use App\Repository\CategoriaRepository;
use App\Repository\NoticiaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    /**
     * @Route("/", name="app_home")
     * @Route("/categoria/{idCat}", name="app_home_con_cat")
     */
    public function index($idCat = null, Request $req, NoticiaRepository $repo, CategoriaRepository $repoCat): Response {
        $urlExtraParam = array();
        $filtros = new FiltrosPortada();
        $form = $this->createForm(FiltroPortadaType::class, $filtros);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute("app_home_con_cat", ["idCat"=>$filtros->getCategoria()->getId()]);
        }
        
        $pag = $req->query->get("pag", 1);
        $categoria = null;
        if($idCat!=null) {
            //Si tenemos valor para idCat en la url, recuperamos la categoría de la bbdd
            $categoria = $repoCat->find($idCat);

            //asígnamos el valor en los filtros
            $filtros->setCategoria($categoria);
            //asignamos el valor en el formulario de filtros
            $form->get("categoria")->setData($categoria);
            //y cubrimos el valor en urlExtraParam para que la paginación lo tenga en cuenta
            $urlExtraParam["idCat"] = $categoria->getId();
        }
        
        $results = $repo->findAllPaginated($pag, $categoria, 5);
        
        $totalPaginas = $results["maxPages"];
        if($pag < 1 || $pag>$totalPaginas) {
            return $this->redirectToRoute("app_home");
        }

        // $noticia = array();
        // $noticia["titulo"] = "Título noticia 1";
        // $noticia["descripcion"] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, sequi officia perspiciatis natus sint cum quam delectus nesciunt ipsum, optio molestias sed quas soluta veniam nemo, quos illo fugit. Enim?";
        // $noticia["rutaImagen"] = "img/foto.png";
        // array_push($arrNoticias, $noticia);

        // $noticia = array();
        // $noticia["titulo"] = "Título noticia 2";
        // $noticia["descripcion"] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, sequi officia perspiciatis natus sint cum quam delectus nesciunt ipsum, optio molestias sed quas soluta veniam nemo, quos illo fugit. Enim?";
        // array_push($arrNoticias, $noticia);

        // $noticia = array();
        // $noticia["titulo"] = "Título noticia 3";
        // $noticia["descripcion"] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, sequi officia perspiciatis natus sint cum quam delectus nesciunt ipsum.";
        // $noticia["rutaImagen"] = "img/foto.png";
        // array_push($arrNoticias, $noticia);

        $arrNoticiasRelacionadas = array();
        $noticia = array();
        $noticia["titulo"] = "Título noticia 1";
        $noticia["fechaPublicacion"] = "2022-04-05T14:00:00";
        $noticia["descripcion"] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, sequi officia perspiciatis natus sint cum quam delectus nesciunt ipsum, optio molestias sed quas soluta veniam nemo, quos illo fugit. Enim?";
        array_push($arrNoticiasRelacionadas, $noticia);

        $noticia = array();
        $noticia["titulo"] = "Título noticia 2";
        $noticia["fechaPublicacion"] = "2022-04-01T14:00:00";
        $noticia["descripcion"] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, sequi officia perspiciatis natus sint cum quam delectus.";
        array_push($arrNoticiasRelacionadas, $noticia);

        return $this->render('home/index.html.twig', [
            'frmSearch' => $form->createView(),
            'arrNoticias' => $results["paginator"],
            'arrNoticiasRelacionadas' => $arrNoticiasRelacionadas,
            'pag' => $pag, 
            'maxPages'=> $totalPaginas,
            'urlExtraParam' => $urlExtraParam
        ]);
    }
}
