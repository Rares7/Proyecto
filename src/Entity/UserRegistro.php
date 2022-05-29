<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as AcmeAssert;
use Symfony\Component\Validator\GroupSequenceProviderInterface;

/**
 * @Assert\GroupSequenceProvider
 */
class UserRegistro extends UserLogin implements GroupSequenceProviderInterface {
    const TIPOS = ["admin", "user", "vip"];
    
    /**
     * @Assert\NotBlank
     */
    private $nombre;
    /**
     * @Assert\NotBlank
     * @Assert\Email
     * @Assert\Regex("/^[^@]+@miempresa\.com$/", groups={"vip"})
     */
    private $email;
    /**
     * @Assert\NotBlank
     * @Assert\Choice(choices=UserRegistro::TIPOS, message="No es una opción válida")
     */
    private $tipo;

    /**
     * @Assert\NotBlank
     * @AcmeAssert\ImparNoNegativo
     */
    private $edad;

    /**
     * @Assert\NotBlank
     * @Assert\Type("App\Entity\Direccion")
     */
    private $direccion;

    public function __construct(string $nombre = "", string $email="", string $tipo="user", string $username = "", string $clave = "") {
        $this->setNombre($nombre);
        $this->setEmail($email);
        $this->setTipo($tipo);
        $this->setUsername($username);
        $this->setClave($clave);
        $this->direccion = new Direccion();
    }

    public function getGroupSequence() {
        $groups = array('UserRegistro');
        if ($this->getTipo()=="vip") {
            $groups[] = 'vip';
        }
        return $groups;
    }

    public function setNombre(?string $nombre) {
        $this->nombre = $nombre;
    }
    public function getNombre():?string {
        return $this->nombre;
    }
    public function setEmail(?string $email) {
        $this->email = $email;
    }
    public function getEmail():?string {
        return $this->email;
    }
    public function setTipo(?string $tipo) {
        $this->tipo = $tipo;
    }
    public function getTipo():?string {
        return $this->tipo;
    }
    public function setEdad($edad) {
        $this->edad = $edad;
    }
    public function getEdad() {
        return $this->edad;
    }
    public function setDireccion(?Direccion $direccion) {
        $this->direccion = $direccion;
    }
    public function getDireccion():?Direccion {
        return $this->direccion;
    }
}