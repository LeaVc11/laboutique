<?php

namespace App\Controller\Admin;

use App\Entity\Carriere;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarriereCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carriere::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
