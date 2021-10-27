<?php

namespace App\Controller;


use App\Classe\Panier;
use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{

    #[Route('/commande', name: 'commande')]
    public function index(Panier $panier, Request $request)
    {
        if (!$this->getUser()->getAdresses()->getValues())
        {
            return $this->redirectToRoute('compte_adresse_ajouter');
        }

        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);

        return $this->render('commande/index.html.twig', [
            'form' => $form->createView(),
            'panier' => $panier->getFull()
        ]);
    }

}
