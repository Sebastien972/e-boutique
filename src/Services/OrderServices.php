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

    }
}