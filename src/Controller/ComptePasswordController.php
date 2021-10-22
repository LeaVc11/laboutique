<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ComptePasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/modifier-password', name: 'compte_password')]
    public function index(Request $request, UserPasswordHasherInterface $encoder)
    {
        $notification=null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        /*   traitement du formulaire*/

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form->get('old_password')->getData();
            /*    dd($old_pwd);*/
            if ($encoder->isPasswordValid($user, $old_pwd)) {
              /*  die('ok)');*/
                $new_pwd = $form->get('new_password')->getData();
                /*dd($new_pwd);*/
                $password=$encoder->hashPassword($user,$new_pwd);

                $user->setPassword($password);
                $this->entityManager->flush();
                $notification="Votre mot de passe a bien été mis à jour.";

            }else{
                $notification="Votre mot de passe actuel n'est le bon";
            }

        }
        return $this->render('compte/password.html.twig',
            [

                /*Affichage dans twig*/
                'form' => $form->createView(),
                'notification'=>$notification
            ]);
    }
}
