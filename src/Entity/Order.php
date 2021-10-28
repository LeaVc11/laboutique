<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="datetime")
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
     * @ORM\Column(type="text")
     */

    private $livraison;

    /**
     * @ORM\OneToMany(targetEntity=DetailCommande::class, mappedBy="commande")
     */
    private $detailCommandes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPay;

    public function __construct()
    {
        $this->detailCommandes = new ArrayCollection();
    }

    public function getTotal()
    {
     /*   dd( $this->getDetailCommandes()->getValues());*/
        $total=null;
        foreach ($this->getDetailCommandes()->getValues() as $product)
        {
$total = $total +($product->getPrix()*$product->getQuantite());
        }
        return $total;
    }

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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
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

    /**
     * @return Collection|DetailCommande[]
     */
    public function getDetailCommandes(): Collection
    {
        return $this->detailCommandes;
    }

    public function addDetailCommande(DetailCommande $detailCommande): self
    {
        if (!$this->detailCommandes->contains($detailCommande)) {
            $this->detailCommandes[] = $detailCommande;
            $detailCommande->setCommande($this);
        }

        return $this;
    }

    public function removeDetailCommande(DetailCommande $detailCommande): self
    {
        if ($this->detailCommandes->removeElement($detailCommande)) {
            // set the owning side to null (unless already changed)
            if ($detailCommande->getCommande() === $this) {
                $detailCommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getIsPay(): ?bool
    {
        return $this->isPay;
    }

    public function setIsPay(bool $isPay): self
    {
        $this->isPay = $isPay;

        return $this;
    }
}
