<?php

namespace App\Controller;

use App\Classe\Panier;
use App\Entity\Adresse;
use App\Form\AdresseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CompteAdresseController extends AbstractController
{
    private $entityManager;

    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/compte/adresses', name: 'compte_adresse')]
    public function index()
    {
         /*dd($this->getUser());*/
        return $this->render('compte/adresse.html.twig');
    }

    #[Route('/compte/ajouter-une-adresse', name: 'compte_adresse_ajouter')]
    public function add(Panier $panier, Request $request)
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $adresse->setUser($this->getUser());
            $this->entityManager->persist($adresse);
            $this->entityManager->flush();

            /*dd($adresse);*/

            if ($panier->get()) {
                return $this->redirectToRoute('commande');
            } else {
                return $this->redirectToRoute('compte_adresse');
            }


        }
            return $this->render('compte/adresse_form.html.twig',
                [
                    'form' => $form->createView()
                ]);
        }

        #[
        Route('/compte/modifier-une-adresse/{id}', name: 'compte_adresse_modifier')]
    public function edit(Request $request, $id)
    {
        $adresse = $this->entityManager->getRepository(Adresse::class)->findOneById($id);

        if (!$adresse || $adresse->getUser() != $this->getUser()) {
            return $this->redirectToRoute('compte_adresse');
        }
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->flush();
            /*dd($adresse);*/
            return $this->redirectToRoute('compte_adresse');
        }
        return $this->render('compte/adresse_form.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
    #[Route('/compte/supprimer-une-adresse/{id}', name: 'compte_adresse_supprimer')]
    public function delete($id)
    {
        $adresse = $this->entityManager->getRepository(Adresse::class)->findOneById($id);

        if (!$adresse || $adresse->getUser() == $this->getUser()) {
            $this->entityManager->remove($adresse);
            $this->entityManager->flush();

        }

        return $this->redirectToRoute('compte_adresse');

    }

}
