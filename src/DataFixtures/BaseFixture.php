<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

/**
 * Class BaseFixture
 * classe abstraite pour simplifier l'enregistrement des entités
 * et permet de récupéré des entité aléatoiremen
 * avec faker
 * @package App\DataFixtures
 */
abstract class BaseFixture extends Fixture
{

    private $manager;
    /**
     * @var Generator
     */
    protected  $faker;


    /**
     * Méthode à implémenter pour charger les entités
     * Une méthode abstraite ne possède pas de corps et doit obligatoirement être implémentée
     * par les classes qui héritent de BaseFixture
     */
    abstract protected function loadData(): void;

    /**
     * Méthode initialement appelée par le système de fixtures
     * On enregistre nos propriétés et on appelle loadData()
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create('fr_FR');

        // Les entités seront générées dans loadData() qui aura donc appelé $manager->persist()
        $this->loadData();
        $this->manager->flush();
    }

    /**
     * Créer un certain nombre d'entités
     * @param int $count        Nombre d'entités à générer
     * @param string $groupName Le nom à donner en référence pour toutes les entités générées
     * @param callable $factory La fonction qui doit générer 1 entité
     */
    protected function createMany(int $count, string $groupName, callable $factory): void
    {
        for ($i = 0; $i < $count; $i++) {
            //  exécute la fonction $factory qui doit retourner l'entité générée
            $entity = $factory($i);

            if ($entity === null) {
                throw new \LogicException('L\'entité doit être retournée !');
            }

            // prépare à l'enregistrement de l'entité
            $this->manager->persist($entity);

            // On enregistre une référence pour l'entité récupérée
            // Afin de pouvoir la récupérer plus tard, dans d'autres classes de Fixtures
            $reference = sprintf('%s_%d', $groupName, $i);
            $this->addReference($reference, $entity);
        }
    }


}