<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Produit;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProduitFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(): void
    {
        //génere 200 produit
        $this->createMany(50, 'produit', function(){
            /**
             * @var Categories $produit
             */
            $categorie = $this->getRandomReference('categorie');

            $nomProduit = $this->faker->firstNameFemale();
            $produit = (new Produit())
                ->setNom($nomProduit)
                ->setPrix($this->faker->randomFloat(1, 20, 99))
                ->setDescription($this->faker->realText())
                ->setProduitVedette($this->faker->boolean())
                ->setImage($this->faker->imageUrl(360, 360, 'animals', true, 'dogs', true))
                ->setMeilleurVente($this->faker->boolean())
                ->setPlusInfos($this->faker->optional()->sentence(10))
                ->setQuantity($this->faker->randomDigit())
                ->setSlug($nomProduit)
                ->addCategorie($categorie)

            ;
            return $produit;

        });



    }

    /**
     * @return string[]
     * permet de charger les dépendence avant d'executé cette page
     */
    public function getDependencies(): array
    {
        return[
            CategorieFixtures::class,
        ];
    }
}
