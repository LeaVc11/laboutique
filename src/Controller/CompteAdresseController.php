<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CompteAdresseController extends AbstractController
{
    #[Route('/compte/adresses', name: 'compte_adresse')]
    public function index()
    {
       /* dd($this->getUser());*/
        return $this->render('compte/adresse.html.twig');
    }
    #[Route('/compte/ajouter-une-adresse', name: 'compte_adresse-ajouter')]
    public function add(Request $request)
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            dd($adresse);
        }
        return $this->render('compte/adresse_ajouter.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

}
