<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BoutiqueService
{

    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }




    public function add(int $id):void
    {

        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        }else{
            $panier[$id] = 1 ;
        }

        $this->session->set('panier', $panier);
    }

    public function remove(int $id):void
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
    }



    public function getFullCart():array
    {
        $panier = $this->session->get('panier', []);

        $dataPanier= [];

        foreach ($panier as $id => $quantity) {
            $dataPanier [] = [
                'product'=>$this->articleRepository->find($id),
                'quantity'=>$quantity
            ];
        }
        return $dataPanier;
    }

    public function getTotal():float
    {
        $total = 0;
        foreach($this->getFullCart() as $item ) {
            $total += $item['product']->getPrix()*$item['quantity'];

        }
        return $total;
    }





















}