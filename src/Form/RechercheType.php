<?php

namespace App\Form;

use App\Classe\Recherche;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('string', TextType::class,
                [
                    'label'=>false,
                    'required'=>false,
                    'attr'=>
                        [
                            'placeholder'=>'Votre recherche....',
                            'class'=>'form-control-sm'
                        ]
                ])
            ->add('categories',EntityType::class,
                [
                    'label'=> false,
                    'required'=>false,
                    'class'=>Category::class,
                    'multiple'=> true,
                    'expanded'=> true,
                ])
        ->add('submit',SubmitType::class,
            [
                'label'=>'Rechercher',
                'attr'=>
                    [
                       'class'=>'btn-block btn-secondary'
                    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recherche::class,
            'method' => 'GET', // Les utilisateur pourront partager des liens.
            'crsf_protection' => false,  //sert pour la sécurité
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
