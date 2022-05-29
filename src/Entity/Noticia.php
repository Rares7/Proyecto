<?php

namespace App\Entity;

use App\Repository\NoticiaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoticiaRepository::class)
 */
class Noticia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $autor;

    /**
     * @ORM\ManyToOne(targetEntity=Categoria::class)
     */
    private $categoria;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaPub;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rutaImagen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(?string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getFechaPub(): ?\DateTimeInterface
    {
        return $this->fechaPub;
    }

    public function setFechaPub(\DateTimeInterface $fechaPub): self
    {
        $this->fechaPub = $fechaPub;

        return $this;
    }

    public function getRutaImagen(): ?string
    {
        return $this->rutaImagen;
    }

    public function setRutaImagen(?string $rutaImagen): self
    {
        $this->rutaImagen = $rutaImagen;

        return $this;
    }

}
