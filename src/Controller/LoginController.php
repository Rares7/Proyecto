<?php

namespace App\Controller;

use App\Form\Type\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserLogin;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function index(Request $request): Response {
        $user = new UserLogin();
        $frmLogin = $this->createForm(LoginType::class, $user);
        $frmLogin->handleRequest($request);
        if($frmLogin->isSubmitted() && $frmLogin->isValid()) {
            if($user->getUsername()==$user->getClave()) {
                $request->getSession()->set("userLogged", $user);
                return $this->redirectToRoute("app_home");
            }
        }

        return $this->render('login/index.html.twig', [
            'frmLogin' => $frmLogin->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(Request $request) {
        $request->getSession()->remove("userLogged");
        return $this->redirectToRoute("app_home");
    }
}
