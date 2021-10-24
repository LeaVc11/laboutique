<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomTransporteur;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTransporteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $livraison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNomTransporteur(): ?string
    {
        return $this->NomTransporteur;
    }

    public function setNomTransporteur(string $NomTransporteur): self
    {
        $this->NomTransporteur = $NomTransporteur;

        return $this;
    }

    public function getPrixTransporteur(): ?float
    {
        return $this->prixTransporteur;
    }

    public function setPrixTransporteur(float $prixTransporteur): self
    {
        $this->prixTransporteur = $prixTransporteur;

        return $this;
    }

    public function getLivraison(): ?string
    {
        return $this->livraison;
    }

    public function setLivraison(string $livraison): self
    {
        $this->livraison = $livraison;

        return $this;
    }
}
