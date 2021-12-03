<?php

namespace App\Controller;

use App\Services\CartServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CartController
 * @package App\Controller
 */
class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(CartServices $cartServices): Response
    {
        $cart = $cartServices->getFullCart();

        $total =  $cartServices->getTotalCart();


        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'total'=> $total,
        ]);


    }

    /**
     * @Route("/add/{id}", name="add", requirements={"id"="\d+"})
     * @param $id
     */
    public function panier($id, CartServices $cartServices)
    {

        $cartServices->add($id);


        return $this->redirectToRoute('cart');



    }
    /**
     * @Route("/remove/{id}", name="remove", requirements={"id"="\d+"})
     */
    public function removpanier($id, CartServices $cartServices)
    {

        $cartServices->remove($id);

        return $this->redirectToRoute('cart');

    }

}
