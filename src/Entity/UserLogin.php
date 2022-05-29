<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class UserLogin {
    /**
     * @Assert\NotBlank
     */
    private $username;
    /**
     * @Assert\NotBlank
     */
    private $clave;

    public function __construct(string $username = "", string $clave = "") {
        $this->setUsername($username);
        $this->setClave($clave);
    }

    public function setUsername(?string $username) {
        $this->username = $username;
    }
    public function getUsername():?string {
        return $this->username;
    }
    public function setClave(?string $clave) {
        $this->clave = $clave;
    }
    public function getClave():?string {
        return $this->clave;
    }
}