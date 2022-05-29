<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contacto {
    /**
     * @Assert\NotBlank
     */
    private $nombre;
    /**
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;
    /**
     * @Assert\NotBlank
     * @Assert\Length(max="40", maxMessage="El asunto no puede tener más de {{ limit }} caracteres")
     */
    private $asunto;
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min="50", 
     *      minMessage="El mensaje no puede tener menos de {{ limit }} caracteres",
     *      max="400", 
     *      maxMessage="El mensaje no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $mensaje;

    public function __construct(string $nombre = "", string $email = "", string $asunto = "", string $mensaje = "") {
        $this->setNombre($nombre);
        $this->setEmail($email);
        $this->setAsunto($asunto);
        $this->setMensaje($mensaje);
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
    public function setAsunto(?string $asunto) {
        $this->asunto = $asunto;
    }
    public function getAsunto():?string {
        return $this->asunto;
    }
    public function setMensaje(?string $mensaje) {
        $this->mensaje = $mensaje;
    }
    public function getMensaje():?string {
        return $this->mensaje;
    }
}