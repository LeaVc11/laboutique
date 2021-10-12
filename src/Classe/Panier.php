<?php

namespace App\Classe;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Panier
{
    private $session;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    public function add($id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);
    }

    public function get()
    {
        return $this->session->get('panier');
    }

    public function remove()
    {
        return $this->session->remove('panier');
    }

    public function delete($id)
    {
        $panier = $this->session->get('panier', []);

        unset($panier[$id]);

        return $this->session->set('panier', $panier);
    }

    public function decrease($id)
    {
// vérifier qi la quantité du produit n'est pas = à 1
        $panier = $this->session->get('panier', []);

        if ($panier[$id] > 1) {
//retirer une quantité (-1)
            $panier[$id]--;
        } else {
            //supprimer le produit
            unset($panier[$id]);
        }
        return $this->session->set('panier', $panier);
    }

    public function getFull()
    {
        $panierComplet = [];
        if ($this->get()) {
            foreach ($this->get() as $id => $quantity)
            {
                $product_object=$this->entityManager->getRepository(Produit::class)->findOneById($id);
                if(!$product_object)
                {
                    $this->delete($id);
                    continue;
                }
                $panierComplet[] =
                    [
                        'product' => $product_object ,
                        'quantity' => $quantity
                    ];
            }
        }
        return $panierComplet;
    }

}
