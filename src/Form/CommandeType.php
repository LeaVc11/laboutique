<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Carriere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /* dd($options);*/
        $user = $options['user'];
        $builder
            ->add('adresse', EntityType::class,
                [
                    'label' => 'Choisissez votre adresse de livraison',
                    'required' => true,
                    'class' => Adresse::class,
                    'choices' => $user->getAdresses(),
                    'multiple' => false,
                    'expanded' => true
                ])
            ->add('transporteurs', EntityType::class,
                [
                    'label' => 'Choisissez votre transporteur',
                    'required' => true,
                    'class' => Carriere::class,
                    'multiple' => false,
                    'expanded' => true
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'Valider',
                    'attr' =>
                        [
                            'class' => 'btn-block btn-secondary '
                        ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user' => array()
        ]);
    }
}
