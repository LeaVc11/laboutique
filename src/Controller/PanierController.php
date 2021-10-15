<?php

namespace App\Controller;

use App\Classe\Panier;
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

        /*        dd($panierComplet);*/
        return $this->render('panier/index.html.twig',
            [
                'panier' => $panier->getFull()
            ]);
    }

    #[Route('/panier/add/{id}', name: 'add_to_panier')]
    public function add(Panier $panier, $id)
    {

        $panier->add($id);

        return $this->redirectToRoute('panier');
    }

    #[Route('/panier/delete/{id}', name: 'delete_mon_panier')]
    public function delete(Panier $panier, $id)
    {

        $panier->delete($id);
        return $this->redirectToRoute('panier');
    }

    #[Route('/panier/decrease/{id}', name: 'decrease_mon_panier')]
    public function decrease(Panier $panier, $id)
    {

        $panier->decrease($id);
        return $this->redirectToRoute('panier');
    }
}
