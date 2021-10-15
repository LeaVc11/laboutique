<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/', name: 'home')]
    public function index()
    {
        $products = $this->entityManager->getRepository(Produit::class)->findByisBest(1);
/*dd($products);*/
        return $this->render('home/index.html.twig',
            [
                'products'=>$products
            ]);
    }
}
