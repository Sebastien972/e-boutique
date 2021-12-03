<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(SessionInterface $session): Response
    {
        $session->set('cart', ['name'=>'session']);
        $cart = $session->get('cart');
        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
        ]);
    }
}
