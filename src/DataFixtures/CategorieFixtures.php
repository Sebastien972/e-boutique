<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends BaseFixture
{


    protected function loadData(): void
    {
        // géneré 6 catégorie
        $this->createMany(6, 'categorie', function (){
            $categorie =(new Categories())
                ->setImage($this->faker->imageUrl)
                ->setName($this->faker->name)
                ->setDescription($this->faker->sentence(8))
            ;

            return $categorie;
        });

    }
}
