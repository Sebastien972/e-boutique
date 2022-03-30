<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends BaseFixture
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $hasher;


    /**
     * Dans la plupart des classes, pour récupérer un service,
     * on peut le demander en argument du constructeur qui est la seule
     * méthode bénéficiant de l'autowiring
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    protected function loadData(): void
    {

        // Générer 3 administrateurs
        $this->createMany(3, 'user_admin', function (int $num) {
            $user = new User();

            $password = $this->hasher->hashPassword($user, 'admin'.$num );

            return $user
                ->setEmail('admin' . $num . '@boutique.fr')
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword($password)
                ->setFirstname($this->faker->firstName($gender = 'male'|'female'))
                ->setIsVerified(true)
                ->setLastname($this->faker->lastName())
                ->setUsername($this->faker->word())

            ;
        });

        // Générer 20 utilisateurs
        $this->createMany(20, 'user_user', function (int $num) {
            $user = new User();
            $password = $this->hasher->hashPassword($user, 'user' . $num);

            return $user
                ->setEmail('user' . $num . '@boutique.fr')
                ->setPassword($password)
                ->setFirstname($this->faker->firstName($gender = 'male'|'female'))
                ->setIsVerified(true)
                ->setLastname($this->faker->lastName())
                ->setUsername($this->faker->word())
            ;
        });

    }
}
