<?php

namespace App\Controller;

use App\Classe\Panier;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{

    private $entityManager;

    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/mon-panier', name: 'panier')]
    public function index(Panier $panier)
    {

        /*dd($panier->get());*/
        $panierComplet = [];

        foreach ($panier->get() as $id => $quantity) {
            $panierComplet[] =
                [
                    'product' => $this->entityManager->getRepository(Produit::class)->findOneById($id),
                    'quantity' => $quantity
                ];
        }
/*        dd($panierComplet);*/

        return $this->render('panier/index.html.twig',
            [
                'panier' => $panierComplet
            ]);
    }

    #[Route('/panier/add/{id}', name: 'add_to_panier')]
    public function add(Panier $panier, $id)
    {
        /*    dd($id);*/

        $panier->add($id);

        return $this->redirectToRoute('panier');
    }

    #[Route('/panier/remove', name: 'remove_mon_panier')]
    public function remove(Panier $panier)
    {

        $panier->remove();
        return $this->redirectToRoute('produits');
    }
}
