<?php


namespace App\Services;


use App\Entity\Cart;
use App\Entity\DetaileCart;
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

    /**
     * @param $data représent les donné a enregisté dans l'entité
     * @param $user l'utilisateur a qui apartien les donne
     */
    public function saveCart($data, $user)
    {

        $reference = $this->generateUuid();
        $adress = $data['checkout']['adresse'];
        $transporteur = $data['checkout']['tansporteur'];
        $information = $data['checkout']['information'];
        $cart = (new Cart())
            ->setCreatedAt(new \DateTime())
            ->setReference($reference)
            ->setTransporteurs($transporteur->getNom)
            ->setTransporteurPrix($transporteur->getPrix)
            ->setFullName($adress->getFullName)
            ->setAdresse($adress)
            ->setQuantity($data['data']['quantity_cart'])
            ->setPlusInfos($information)
            ->setSubTotalTTC($data['data']['subTotalTTC']+$transporteur->getPrix()/100)
            ->setUser($user)
        ;

        $this->manager->persist($cart);


        $cart_detail = [];
        foreach ($data['produduit'] as $produir)
            $cart_detail = new DetaileCart();


    }

    /**
     * @return string
     * génere un code Uuid
     */
    public function generateUuid(): string
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