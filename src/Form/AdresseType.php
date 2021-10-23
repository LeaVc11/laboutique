<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Quel nom souhaitez-vous donner à votre adresse ?',
                'attr' => [
                    'placeholder' => 'Nommez votre adresse'
                ]
            ])

            ->add('nom', TextType::class,
                [
                    'label'=> 'Votre nom ',
                    'attr'=>
                        [
                            'placeholder'=>'Entrez votre nom'
                        ]
                ] )
            ->add('prenom', TextType::class,
                [
                    'label'=> 'Votre prénom',
                    'attr'=>
                        [
                            'placeholder'=>'Entrez votre prénom'
                        ]
                ] )
            ->add('entreprise', TextType::class,
        [
            'label'=> 'Votre société ?',
            'attr'=>
                [
                    'placeholder'=>'Entrez le nom de votre société (facultatif)'
                ]
        ] )
            ->add('adresse', TextType::class,
                [
                    'label'=> 'Votre adresse',
                    'attr'=>
                        [
                            'placeholder'=>'10 rue du 6 juin 1945'
                        ]
                ] )
            ->add('codePostal', TextType::class,
                [
                    'label'=> 'Votre code postal ?',
                    'attr'=>
                        [
                            'placeholder'=>'Entrez votre code postal'
                        ]
                ] )
            ->add('ville', TextType::class,
                [
                    'label'=> 'Votre ville',
                    'attr'=>
                        [
                            'placeholder'=>'Entrez votre ville'
                        ]
                ] )
            ->add('pays', CountryType::class,
                [
                    'label'=> 'Pays',
                    'attr'=>
                        [
                            'placeholder'=>'Entrez votre pays'
                        ]
                ] )
            ->add('telephone', TelType::class,
                [
                    'label'=> 'Votre téléphone',
                    'attr'=>
                        [
                            'placeholder'=>'Entrez votre téléphone'
                        ]
                ] )
            ->add('submit', SubmitType::class,
                [
                    'label'=> 'Ajouter mon adresse',
                    'attr'=>
                        [
                            'class'=> 'btn-block btn-secondary '
                        ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
