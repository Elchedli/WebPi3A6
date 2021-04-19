<?php

namespace App\Controller\Admin;

use App\Entity\Psycho;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PsychoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Psycho::class;
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
