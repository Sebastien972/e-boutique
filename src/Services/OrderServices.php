<?php


namespace App\Services;


use App\Entity\Cart;
use App\Entity\Commande;
use App\Entity\DetaileCart;
use App\Entity\DetaileCommande;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrderServices
{

    private $manager;
    public function __construct(EntityManagerInterface $manager, ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
        $this->manager = $manager;
    }

    public function getLineItemes($cart)
    {
        $DetaileCart = $cart->getDetaileCarts();
        $line_items=[];
        foreach ($DetaileCart as $detail) {
            $produit = $this->produitRepository->findOneByNom($detail->getNomProduit());
  
            $line_items[] = [
              'price_data'=>[
                'currency'=>'EUR',
                'unit_amount'=>$produit->getPrix()*100,
                'product_data'=>[
                  'name'=>$produit->getNom(),
                  'images'=>[$_ENV['YOUR_DOMAIN'].'/upload/produit/'.$produit->getImage()],
               ],
              ],
              
            //   'price' => '{{PRICE_ID}}',
              'quantity' => $detail->getQuantity(),
            ];
        }

        //transporteur
        $line_items[] = [
            'price_data'=>[
              'currency'=>'EUR',
              'unit_amount'=>$cart->getTransporteurPrix()*100,
              'product_data'=>[
                'name'=>$cart->getTransporteurs(),
             ],
            ],
            
            // 'price' => '{{PRICE_ID}}',
            'quantity' => 1,
          ];

          return $line_items;
    }

    public function creatOrder($cart)
    {
        $order = (new Commande())
            ->setCreatedAt($cart->getCreatedAt())
            ->setReference($cart->getReference())
            ->setTransporteurs($cart->getTransporteurs())
            ->setTransporteurPrix($cart->getTransporteurPrix())
            ->setFullName($cart->getFullName())
            ->setAdresse($cart->getAdresse())
            ->setQuantity($cart->getQuantity())
            ->setPlusInfos($cart->getPlusInfos())
            ->setSubTotalTTC($cart->getSubTotalTTC())
            ->setUser($cart->getUser());
        $this->manager->persist($order);

        $produit = $cart->getDetaileCarts()->getValues();
        foreach ($produit as $cart_produit){
            $orderDetail = (new DetaileCommande())
            ->setNomProduit($cart_produit->getNomProduit())
            ->setPrixProduit($cart_produit->getPrixProduit())
            ->setQuantity($cart_produit->getQuantity())
            ->setPrixTotalTTC($cart_produit->getPrixTotalTTC()) 
            ->setCommande($order)
            
            ;
        $this->manager->persist($orderDetail);
        }
        $this->manager->flush();
        return $order;

    }

    /**
     * @param $data représent les donné a enregisté dans l'entité
     * @param $user l'utilisateur a qui apartien les donne
     */
    public function saveCart($data, $user)
    {

        $reference = $this->generateUuid();
        $adress = $data['checkout']['adresse'];
        $transporteur = $data['checkout']['transporteur'];
        $information = $data['checkout']['information'];
        $cart = new Cart();
        $cart->setCreatedAt(new \DateTime())
            ->setReference($reference)
            ->setTransporteurs($transporteur->getNom())
            ->setTransporteurPrix($transporteur->getPrix())
            ->setFullName($adress->getFullName())
            ->setAdresse($adress)
            ->setQuantity($data['data']['quantityCart'])
            ->setPlusInfos($information)
            ->setSubTotalTTC($data['data']['subTotall']+$transporteur->getPrix())
            ->setUser($user)
        ;
        $cart_detail = [];

        $this->manager->persist($cart);


        $cart_detail = [];
        foreach ($data['produit'] as $produit){
            $cartDetail = (new DetaileCart())
            ->setNomProduit($produit['produit']->getNom())
            ->setPrixProduit($produit['produit']->getPrix())
            ->setQuantity($produit['quantity'])
            ->setPrixTotalTTC($produit['produit']->getPrix()*$produit['quantity']) 
            ->setCart($cart)
            ->setPrixTotal($produit['produit']->getPrix()*$produit['quantity'])
            ;
        $this->manager->persist($cartDetail);
            $cart_detail[] = $cartDetail;
        }


        $this->manager->flush();
        return $reference;
    }

    /**
     * @return string
     * génere un code Uuid
     */
    public function generateUuid(): string
    {
        mt_srand((double)microtime()*10000);

        $charid = strtoupper(md5(uniqid(rand(), true)));
        

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