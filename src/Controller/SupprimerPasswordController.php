<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\SupprimerPassword;
use App\Entity\User;
use App\Form\SupprimerPasswordType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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

        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }
        if ($request->get('email')) {
            /*  dd($request->get('email'));*/
            $user = $this->entityManager->getRepository(User::class)->findOneByEmail($request->get('email'));
            /* dd($user);*/
            if ($user) {
                // Etape 1 : Enregistre en BDD la demande de supprimer avec user, token, createAt
                $supprimer_password = new SupprimerPassword();
                $supprimer_password->setUser($user);
                $supprimer_password->setToken(uniqid());
                $supprimer_password->setCreateAt(new DateTime());
                $this->entityManager->persist($supprimer_password);
                $this->entityManager->flush();

                //Envoyer un mail à l'utilisateur avec un lien qui permet de mettre à jour son mot de passe

                $url = $this->generateUrl('modifier_password',
                    [
                        'token' => $supprimer_password->getToken()
                    ]);

                $content = "Bonjour" . $user->getPrenom() . "<br/>Vous avez demandé à réinitialiser votre de passe sur le site La Boutique La Marque 42.<br/><br/>";
                $content .= "Merci de bien vouloir cliquer sur le lien suivant pour <a href='" . $url . "'> mettre à jour votre mot de passe</a> ";
                $mail = new Mail();
                $mail->send($user->getEmail(), $user->getPrenom() . ' ' . $user->getNom(), 'Réinitialiser votre mot de passe sur la boutique "La Marque 42."', $content);

                $this->addFlash('notice', 'Vous allez recevoir dans quelques secondes un mail avec la procédure pour réinitialiser votre de passe. ');
            } else {
                $this->addFlash('notice', 'Cette adresse email est inconnue. ');
            }
        }

        return $this->render('supprimer_password/index.html.twig');
    }

    #[Route('/mot-de-passe-modifier/{token}', name: 'modifier_password')]
    public function update(Request $request, $token, UserPasswordHasherInterface $encoder)
    {
        /*dd($token);*/
        $supprimer_password = $this->entityManager->getRepository((SupprimerPassword::class))->findOneByToken($token);

        if (!$supprimer_password) {
            return $this->redirectToRoute($supprimer_password);
        }


        // vérifier si le createdAt = maintenant(now) - 3h

        $now = new DateTime();
        if ($now > $supprimer_password->getCreateAt()->modify('+ 3 hour')) {
            /*    die('ok');*/
            /*          dump($now);
                        dump($now < $supprimer_password->getCreateAt()->modify('+ 3 hour'));*/

            $this->addFlash('notice', 'Votre demande de mot de passe a expiré. Merci de la renouveler. ');
            return $this->redirectToRoute('supprimer_password');
        }
        // rendre une vue mot de passe et confirmer votre mot de passe

        $form = $this->createForm(SupprimerPasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /*  dd($form->getData());*/
            $new_pwd = $form->get('new_password')->getData();
           /* dd($new_pwd);*/


            //Encodage des mots de passe

            $password = $encoder->hashPassword($supprimer_password->getUser(), $new_pwd);
            $supprimer_password->getUser()->setPassword($password);

            //Flush en BDD
            $this->entityManager->flush();

            //Redirection de l'utilisateur vers la page de connexion
            $this->addFlash('notice', 'Votre mot de passe a bien été mis à jour');
            return $this->redirectToRoute('compte');
        }

        return $this->render('supprimer_password/update.html.twig',
            [
                'form' => $form->createView()
            ]);


          dd($supprimer_password);
    }
}
