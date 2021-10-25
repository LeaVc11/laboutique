<?php

namespace App\Controller;

use App\Entity\SupprimerPassword;
use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class SupprimerPasswordController extends AbstractController
{
    private $entityManager;

    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/mot-de-passe-oublie', name: 'supprimer_password')]
    public function index(Request $request)
    {

        if ($this->getUser())
        {
            return $this->redirectToRoute('home');
        }
        if ($request->get('email'))
        {
          /*  dd($request->get('email'));*/
            $user = $this->entityManager->getRepository(User::class)->findOneByEmail($request->get('email'));
           /* dd($user);*/
            if ($user)
            {
                // Etape 1 : Enregistre en BDD la demande de supprimer avec user, token, createAt
                $supprimer_password = new SupprimerPassword();
                $supprimer_password->setUser($user);
                $supprimer_password->setToken(uniqid());
                $supprimer_password->setCreateAt(new DateTime());
                $this->entityManager->persist($supprimer_password);
                $this->entityManager->flush();

                //Envoyer un mail à l'utilisateur avec un lien qui permet de mettre à jour son mot de passe



            }
        }

        return $this->render('supprimer_password/index.html.twig');
    }
/*    #[Route('/mot-de-passe-modifier/{token', name: 'modifier_password')]
    public function index(Request $request)
    {

    }*/
}
