<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class CompteAdresseController extends AbstractController
{
    #[Route('/compte/adresse', name: 'compte_adresse')]
    public function index()
    {
        return $this->render('compte/index.html.twig');
    }
}
