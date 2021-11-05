<?php

namespace App\Controller;


use App\Classe\Panier;
use App\Entity\DetailCommande;
use App\Entity\Order;
use App\Form\CommandeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    private $entityManager;

    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


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


    #[Route('/commande/recapitulatif', name: 'commande_recap', methods: 'POST')]
    public function add(Panier $panier, Request $request)
    {

        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $date = new \DateTime();

            $transporteurs = $form->get('transporteurs')->getData();

            $livraison = $form->get('adresse')->getData();
            $livraison_contenu = $livraison->getPrenom() . ' ' . $livraison->getNom();
            $livraison_contenu .= '<br/>' . $livraison->getTelephone();

            if ($livraison->getEntreprise()) {
                $livraison_contenu .= '<br/>' . $livraison->getName();
            }

            $livraison_contenu .= '<br/>' . $livraison->getAdresse();
            $livraison_contenu .= '<br/>' . $livraison->getCodePostal() . ' ' . $livraison->getVille();
            $livraison_contenu .= '<br/>' . $livraison->getPays();

            /*    dd($livraison_contenu);*/

            /*     dd($transporteurs);*/
            /*    dd($livraison);*/


            // Enregistrer la commande
            $commande = new Order();
            $commande->setUser($this->getUser());
            $commande->setCreatedAt($date);
            $commande->setNomTransporteur($transporteurs->getNom());
            $commande->setPrixTransporteur($transporteurs->getPrix());
            $commande->setLivraison($livraison_contenu);


            $this->entityManager->persist($commande);


            // Enregistrer le détail de la commande
            foreach ($panier->getFull() as $produit) {

                $commandeDetails = new DetailCommande();
                $commandeDetails->setCommande($commande);
                $commandeDetails->setProduit($produit['product']->getNom());
                $commandeDetails->setQuantite($produit['quantity']);
                $commandeDetails->setPrix($produit['product']->getPrix());
                $commandeDetails->setTotal($produit['product']->getPrix() * $produit['quantity']);


                $this->entityManager->persist($commandeDetails);
                /* dd($produit);*/
            }

            $this->entityManager->flush();

            /*       dd($form->getData());*/
            return $this->render('commande/ajouter.html.twig', [
                'panier' => $panier->getFull(),
                'transporteur' => $transporteurs,
                'livraison' => $livraison_contenu
            ]);
        }

        return $this->redirectToRoute('panier');
    }

}
