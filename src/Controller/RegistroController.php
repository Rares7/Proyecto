<?php

namespace App\Controller;

use App\Entity\UserRegistro;
use App\Form\Type\RegistroType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistroController extends AbstractController
{
    /**
     * @Route("/registro", name="app_registro")
     */
    public function index(Request $request): Response {

        $user = new UserRegistro();
        $form = $this->createForm(RegistroType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            
        }

        return $this->render('registro/index.html.twig', [
            "frmRegistro" => $form->createView()
        ]);
    }
}
