<?php

namespace App\Controller\Admin;

use App\Entity\Entete;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EnteteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Entete::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre', 'Titre du header'),
            TextareaField::new('contenu', 'Contenu du header'),
            TextField::new('boutonTitre', 'Titre du bouton'),
            TextField::new('boutonUrl', 'Url de destination du bouton'),
            ImageField::new('illustration')
            /* pour avoir l'image avec easyAdmin => on se sert de combinaison de propriété*/
            ->setBasePath('uploads')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }

}
