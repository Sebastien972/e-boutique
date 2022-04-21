<?php

namespace App\Controller\Admin;

use App\Entity\Cart;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CartCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cart::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('reference'),
            TextField::new('User.fullName'),
            TextField::new('fullName'),
            TextField::new('transporteurs', 'transpourteur'),
            MoneyField::new('transporteurPrix', 'prix du transporteur')->setCurrency('EUR'),
            BooleanField::new('isPaid')->hideWhenUpdating(),
            MoneyField::new('subTotalTTC', 'total commande')->setCurrency('EUR'),

        ];
    }
}
