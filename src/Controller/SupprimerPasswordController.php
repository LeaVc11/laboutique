<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupprimerPasswordController extends AbstractController
{
    #[Route('/mot-de-passe-oublie/password', name: 'supprimer_password')]
    public function index(): Response
    {
        return $this->render('supprimer_password/index.html.twig');
    }
}
