<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\YorumlarRepository")
 */
class Yorumlar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $yorumid;

    /**
     * @ORM\Column(type="integer")
     */
    private $parentid;

    /**
     * @ORM\Column(type="text")
     */
    private $yorum;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $yorumtarihi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $yorumadi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $yorummail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYorumid(): ?int
    {
        return $this->yorumid;
    }

    public function setYorumid(int $yorumid): self
    {
        $this->yorumid = $yorumid;

        return $this;
    }

    public function getParentid(): ?int
    {
        return $this->parentid;
    }

    public function setParentid(int $parentid): self
    {
        $this->parentid = $parentid;

        return $this;
    }

    public function getYorum(): ?string
    {
        return $this->yorum;
    }

    public function setYorum(string $yorum): self
    {
        $this->yorum = $yorum;

        return $this;
    }

    public function getYorumtarihi(): ?string
    {
        return $this->yorumtarihi;
    }

    public function setYorumtarihi(?string $yorumtarihi): self
    {
        $this->yorumtarihi = $yorumtarihi;

        return $this;
    }

    public function getYorumadi(): ?string
    {
        return $this->yorumadi;
    }

    public function setYorumadi(?string $yorumadi): self
    {
        $this->yorumadi = $yorumadi;

        return $this;
    }

    public function getYorummail(): ?string
    {
        return $this->yorummail;
    }

    public function setYorummail(?string $yorummail): self
    {
        $this->yorummail = $yorummail;

        return $this;
    }
}
