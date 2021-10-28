<?php

namespace App\Controller\Admin;

use App\Entity\Carriere;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarriereCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carriere::class;
    }


    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('nom'),/* ATTENTION ECRIRE LA MEME CHOSE QUE DS PRODUIT.PHP*/
            TextareaField::new('description'),/* ATTENTION ECRIRE LA MEME CHOSE QUE DS PRODUIT.PHP*/
            ImageField::new('illustration')/* ATTENTION ECRIRE LA MEME CHOSE QUE DS PRODUIT.PHP*/
            /* pour avoir l'image avec easyAdmin => on se sert de combinaison de propriété*/
            ->setBasePath('uploads')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),

        ];

    }
}
