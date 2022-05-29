<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DondeEstamosController extends AbstractController
{
    /**
     * @Route("/donde-estamos", name="app_donde_estamos")
     */
    public function index(): Response
    {
        

        return $this->render('donde_estamos/index.html.twig', [
            'controller_name' => 'DondeEstamosController',
        ]);
    }
}
