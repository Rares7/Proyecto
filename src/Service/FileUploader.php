<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $slugger;
    private $targetDirectory;
    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }
    public function upload(UploadedFile $imageUploaded)
    {
        $rutaImagen = "";

        if ($imageUploaded) {
            $originalFilename = pathinfo($imageUploaded->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageUploaded->guessExtension();
            try {
                $mes = date('n');
                $imageUploaded->move("uploads/$mes/", $newFilename);
                $rutaImagen = $this->targetDirectory."/$mes/$newFilename";
            } catch (FileException $e) {
            }
        }
        return $rutaImagen;
    }
}
