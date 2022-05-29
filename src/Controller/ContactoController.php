<?php

namespace App\Controller;

use App\Entity\Contacto;
use App\Form\Type\ContactoType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ContactoController extends AbstractController
{
    /**
     * @Route("/contacto", name="app_contacto")
     */
    public function index(Request $request, SluggerInterface $slugger, FileUploader $fileUploader): Response {

        $contacto = new Contacto();
        $rutaImagen  = "";
        $frm = $this->createForm(ContactoType::class, $contacto);
        $frm->handleRequest($request);
        if($frm->isSubmitted() && $frm->isValid()) {
            $imageUploaded = $frm->get('imagen')->getData();
            $rutaImagen = $fileUploader->upload($imageUploaded);
            // if ($imageUploaded) {
            //     $originalFilename = pathinfo($imageUploaded->getClientOriginalName(), PATHINFO_FILENAME);
            //     $safeFilename = $slugger->slug($originalFilename);
            //     $newFilename = $safeFilename.'-'.uniqid().'.'.$imageUploaded->guessExtension();
            //     try {
            //         $mes = date('n');
            //         $imageUploaded->move("uploads/$mes/", $newFilename);
            //         $rutaImagen = "uploads/$mes/$newFilename";
            //     } catch (FileException $e) { }
            // }
        }

        return $this->render('contacto/index.html.twig', [
            'frmContacto' => $frm->createView(),
            'contacto' => $contacto,
            'hasContacto' => $frm->isSubmitted() && $frm->isValid(),
            'rutaImagen' => $rutaImagen
        ]);
    }
}
