<?php

namespace App\DataFixtures;

use App\Entity\Transporteurs;

class TransporteurFixtures extends BaseFixture
{

    protected function loadData(): void
    {
        // géne 3 transporteur
        $this->createMany(3, 'transporteur', function (){
            $transporteur = (new Transporteurs())
                ->setNom($this->faker->name)
                ->setDescription($this->faker->realText())
                ->setPrix($this->faker->randomFloat(1, 20, 99))
            ;
            return $transporteur;

        });
    }
}
