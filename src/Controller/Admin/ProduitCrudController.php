<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }


    public function configureFields(string $pageName): iterable
    {
return
    [
        TextField::new('nom'),/* ATTENTION ECRIRE LA MEME CHOSE QUE DS PRODUIT.PHP*/
        SlugField::new('slug')/* ATTENTION ECRIRE LA MEME CHOSE QUE DS PRODUIT.PHP*/->setTargetFieldName('nom'),
        ImageField::new('illustration')/* ATTENTION ECRIRE LA MEME CHOSE QUE DS PRODUIT.PHP*/
           /* pour avoir l'image avec easyAdmin => on se sert de combinaison de propriété*/
            ->setBasePath('uploads')
            ->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
        TextField::new('subtitle'),/* ATTENTION ECRIRE LA MEME CHOSE QUE DS PRODUIT.PHP*/
        TextareaField::new('description'),/* ATTENTION ECRIRE LA MEME CHOSE QUE DS PRODUIT.PHP*/
        MoneyField::new('prix','Prix')/* ATTENTION ECRIRE LA MEME CHOSE QUE DS PRODUIT.PHP*/->setCurrency('EUR'),
        AssociationField::new('category')/* ATTENTION ECRIRE LA MEME CHOSE QUE DS PRODUIT.PHP*/

    ];
    }

}
