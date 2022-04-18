<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('reference'),
            TextField::new('fullName'),
            TextField::new('transporteurs', 'transpourteur'),
            MoneyField::new('transporteurPrix', 'prix du transporteur')->setCurrency('EUR'),
            BooleanField::new('isPaid'),
            MoneyField::new('subTotalTTC', 'total commande')->setCurrency('EUR'),

        ];
    }
}
