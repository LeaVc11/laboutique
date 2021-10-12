<?php

namespace App\Controller;

use App\Classe\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/mon-panier', name: 'panier')]
    public function index(Panier $panier)
    {

        dd($panier->get());

        return $this->render('panier/index.html.twig');
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
