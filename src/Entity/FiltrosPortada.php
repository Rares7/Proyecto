<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class FiltrosPortada {
    private $categoria;
    
    public function __construct(string $nombre = "", string $email = "", string $asunto = "", string $mensaje = "") {
        $this->categoria = new Categoria();
    }

    public function setCategoria(?Categoria $categoria) {
        $this->categoria = $categoria;
    }
    public function getCategoria():?Categoria {
        return $this->categoria;
    }
}