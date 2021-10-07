<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{

    private $entityManager;

    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/nos-produits', name: 'produits')]
    public function index()
    {
        $products = $this->entityManager->getRepository(Produit::class)->findAll();

    /* dd($products);*/

        return $this->render('produit/index.html.twig',
            [
                'products' => $products
            ]);
    }
}
