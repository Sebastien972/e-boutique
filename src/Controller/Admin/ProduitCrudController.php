<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            SlugField::new('slug')->setTargetFieldName('nom')->hideOnForm(),
            IntegerField::new('quantity'),
            TextField::new('nom'),
            TextEditorField::new('description'),
            TextEditorField::new('plusInfos'),
            TextField::new('tags'),
            MoneyField::new('prix')->setCurrency('EUR'),
            BooleanField::new('meilleurVente', 'Meilleur vente'),
            BooleanField::new('produitVedette'),
            AssociationField::new('categorie'),
            ImageField::new('image')->setBasePath('/assets/upload/produit/')
                ->setUploadDir('/public/assets/upload/produit/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            //DateTimeField::new('createdAt')->hideOnForm(),

        ];
    }

}
