<?php

namespace App\Controller;


use App\Classe\Panier;
use App\Entity\Order;
use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{

    #[Route('/commande', name: 'commande')]
    public function index(Panier $panier, Request $request)
    {
        if (!$this->getUser()->getAdresses()->getValues()) {
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

    /*   pay*/
    #[Route('/commande/recapitulatif', name: 'commande_recap')]
    public function ajouter(Panier $panier, Request $request)
    {

        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*dd($form->getData());*/
            $date=new \DateTime();
            $transporteurs = $form->get('transporteurs')->getData();

            $livraison = $form->get('adresse')->getData();

            $livraison_contenu = $livraison->getPrenom() . '' . $livraison->getNom();
            $livraison_contenu = $livraison->getTelephone() ;
            if ($livraison->getEntreprise())
            {
                $livraison_contenu .= '<br/>'.$livraison->getEntreprise();
            }
            $livraison_contenu .= '<br/>'.$livraison->getAdresse();
            $livraison_contenu .= '<br/>'.$livraison->getCodepostal().''.$livraison->getVille();
            $livraison_contenu .= '<br/>'.$livraison->getPays();
            /*       dd($transporteurs);*/
           /* dd($livraison_contenu);*/

            // Enregistrer ma commande

            $order = new Order();
            $order->setUser($this->getUser());
            $order->setCreatedAt($date);
            $order->setNomTransporteur($transporteurs->getName);
            $order->setPrixTransporteur($transporteurs->getprix);
            $order->setLivraison($livraison_contenu);

            //Enregistrer mes produits/**/
        }

        return $this->render('commande/ajouter.html.twig', [
            'panier' => $panier->getFull()
        ]);
    }
}
