<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GonderiRepository")
 */
class Gonderi
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gonderibasligi;

    /**
     * @ORM\Column(type="text")
     */
    private $gonderiicerigi;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $gonderitarihi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kapak;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kategori;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGonderibasligi(): ?string
    {
        return $this->gonderibasligi;
    }

    public function setGonderibasligi(string $gonderibasligi): self
    {
        $this->gonderibasligi = $gonderibasligi;

        return $this;
    }

    public function getGonderiicerigi(): ?string
    {
        return $this->gonderiicerigi;
    }

    public function setGonderiicerigi(string $gonderiicerigi): self
    {
        $this->gonderiicerigi = $gonderiicerigi;

        return $this;
    }

    public function getGonderitarihi(): ?string
    {
        return $this->gonderitarihi;
    }

    public function setGonderitarihi(string $gonderitarihi): self
    {
        $this->gonderitarihi = $gonderitarihi;

        return $this;
    }

    public function getKapak(): ?string
    {
        return $this->kapak;
    }

    public function setKapak(string $kapak): self
    {
        $this->kapak = $kapak;

        return $this;
    }

    public function getKategori(): ?string
    {
        return $this->kategori;
    }

    public function setKategori(string $kategori): self
    {
        $this->kategori = $kategori;

        return $this;
    }
}
