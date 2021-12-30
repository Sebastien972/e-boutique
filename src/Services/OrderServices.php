<?php


namespace App\Services;


use Doctrine\ORM\EntityManagerInterface;

class OrderServices
{

    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    public function creatOrder($cart)
    {

    }

    public function saveCart($cart, $user)
    {

    }
    public function generateUuid()
    {
        mt_srand((double)microtime()*10000);

        $charid = strtroupper(md5(uniqid(rand(), true)));

        $hyphen = chr(45);
        $uuid = ""
            .substr($charid, 0,8).$hyphen
            .substr($charid, 8,4).$hyphen
            .substr($charid, 12,4).$hyphen
            .substr($charid, 16,4).$hyphen
            .substr($charid, 20,12).$hyphen
        ;
        return $uuid;

    }
}