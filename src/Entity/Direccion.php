<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Direccion {
    /**
     * @Assert\NotBlank
     */
    private $direccion;
    /**
     * @Assert\NotBlank
     */
    private $localidad;
    /**
     * @Assert\NotBlank
     */
    private $provincia;
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min="5", 
     *      minMessage="El cp no puede tener menos de {{ limit }} caracteres",
     * )
     */
    private $cp;

    public function __construct(string $direccion = "calle", string $localidad = "", string $provincia = "", string $cp = "") {
        $this->setDireccion($direccion);
        $this->setLocalidad($localidad);
        $this->setProvincia($provincia);
        $this->setCp($cp);
    }

    public function setDireccion(?string $direccion) {
        $this->direccion = $direccion;
    }
    public function getDireccion():?string {
        return $this->direccion;
    }
    public function setLocalidad(?string $localidad) {
        $this->localidad = $localidad;
    }
    public function getLocalidad():?string {
        return $this->localidad;
    }
    public function setProvincia(?string $provincia) {
        $this->provincia = $provincia;
    }
    public function getProvincia():?string {
        return $this->provincia;
    }
    public function setCp(?string $cp) {
        $this->cp = $cp;
    }
    public function getCp():?string {
        return $this->cp;
    }
}