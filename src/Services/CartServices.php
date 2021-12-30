<?php

namespace App\Services;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartServices
{

    protected $session;


    public function __construct(SessionInterface $session, ProduitRepository $produitRepository)
    {
        $this->session = $session;
        $this->produitRepository = $produitRepository;
    }


    /**
     * @param $panier
     */
    public function updateCart($panier)
    {
        $this->session->set('panier', $panier);
        $this->session->set('panierData', $this->getFullCart());

    }

    public function add(int $id):void
    {

        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        }else{
            $panier[$id] = 1 ;
        }

        $this->updateCart($panier);
    }

    public function remove(int $id):void
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{

                unset($panier[$id]);
            }
        }
        $this->updateCart($panier);
    }

    public function removeAllItem(int $id):void
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {

            unset($panier[$id]);

        }
        $this->updateCart($panier);
    }

    public function removeAllCart(int $id):void
    {
        $this->updateCart([]);

    }

    /**
     * @return array
     *
     */
    public function getFullCart():array
    {
        $panier = $this->session->get('panier', []);

        $dataPanier = [];

        foreach ($panier as $id => $quantity) {
            $produit = $this->produitRepository->find($id);
            if ($produit){

                $dataPanier [] = [
                    'product'=> $produit,
                    'quantity'=>$quantity,
                ];
            }else{
                $this->remove($id);
            }

        }
        return $dataPanier;
    }

    public function getTotalCart():float
    {
        $total = 0;
        foreach($this->getFullCart() as $item ) {
            $total += $item['product']->getPrix()*$item['quantity'];

        }
        return $total;
    }





















}