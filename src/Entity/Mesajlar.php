<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MesajlarRepository")
 */
class Mesajlar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mailadresi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $konu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mesaj;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdi(): ?string
    {
        return $this->adi;
    }

    public function setAdi(?string $adi): self
    {
        $this->adi = $adi;

        return $this;
    }

    public function getMailadresi(): ?string
    {
        return $this->mailadresi;
    }

    public function setMailadresi(?string $mailadresi): self
    {
        $this->mailadresi = $mailadresi;

        return $this;
    }

    public function getKonu(): ?string
    {
        return $this->konu;
    }

    public function setKonu(?string $konu): self
    {
        $this->konu = $konu;

        return $this;
    }

    public function getMesaj(): ?string
    {
        return $this->mesaj;
    }

    public function setMesaj(?string $mesaj): self
    {
        $this->mesaj = $mesaj;

        return $this;
    }
}
