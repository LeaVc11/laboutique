<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Header;
use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class InscriptionController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/inscription', name: 'inscription')]
    public function index(Request $request, UserPasswordHasherInterface $encoder)
    {


        $notification = null;
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $recherche_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if(!$recherche_email)
            {
                $password = $encoder->hashPassword($user, $user->getPassword());

                $user->setPassword($password);
                /*  dd($user);*/

                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $mail = new Mail();
                $content = "Bonjour ".$user->getPrenom()."<br/>Bienvenue sur la première boutique dédiée au made in LOIRE.";
                $mail->send($user->getEmail(), $user->getPrenom(), 'Bienvenue sur La Boutique La Marque 42', $content);

                $notification = "Votre inscription s'est correctement déroulée. Vous pouvez dès à présent vous connecter à votre compte.";
            } else {
                $notification = "L'email que vous avez renseigné existe déjà.";
            }

        }
        return $this->render('inscription/index.html.twig',
            [
                'form' => $form->createView(),
                'notification' => $notification,

            ]);
    }
}
