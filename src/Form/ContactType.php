<?php

namespace App\Form;

use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,
                [
                    'label' => 'Votre nom',
                    'attr' =>
                        [
                            'placeholder' => 'Merci de saisir votre nom'
                        ]
                ])
            ->add('prenom', TextType::class,
                [
                    'label' => 'Votre prénom',
                    'attr' =>
                        [
                            'placeholder' => 'Merci de saisir votre prénom'
                        ]
                ])
            ->add('email', EmailType::class,
                [
                    'label' => 'Votre email',
                    'attr' =>
                        [
                            'placeholder' => 'Merci de saisir votre email'
                        ]
                ])
            ->add('contenu', TextareaType::class,
                [
                    'label' => 'Votre message',
                    'attr' =>
                        [
                            'placeholder' => 'Merci de saisir votre message'
                        ]
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'Envoyer',
                    'attr' =>
                        [
                            'class' => 'btn-block btn-secondary'
                        ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
