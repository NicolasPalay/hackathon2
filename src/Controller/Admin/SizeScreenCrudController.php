<?php

namespace App\Controller\Admin;

use App\Entity\SizeScreen;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SizeScreenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SizeScreen::class;
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
