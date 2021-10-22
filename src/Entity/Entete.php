<?php

namespace App\Entity;

use App\Repository\EnteteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HeaderRepository::class)
 */
class Entete
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $boutonTitre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $boutonUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Illustration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getBoutonTitre(): ?string
    {
        return $this->boutonTitre;
    }

    public function setBoutonTitre(string $boutonTitre): self
    {
        $this->boutonTitre = $boutonTitre;

        return $this;
    }

    public function getBoutonUrl(): ?string
    {
        return $this->boutonUrl;
    }

    public function setBoutonUrl(string $boutonUrl): self
    {
        $this->boutonUrl = $boutonUrl;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->Illustration;
    }

    public function setIllustration(string $Illustration): self
    {
        $this->Illustration = $Illustration;

        return $this;
    }
}
