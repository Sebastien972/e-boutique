<?php

namespace App\Controller;

use App\Form\CheckoutFormType;
use App\Services\CartServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    /**
     * @Route("/checkout", name="checkout")
     */
    public function index(CartServices $cartServices, Request $request): Response
    {
        $user = $this->getUser();

        $cart = $cartServices->getFullCart();

        if (empty($cart)){
           return $this->redirectToRoute('home');
        }
        if (empty($user->getAdresses()->getValues())){
            return $this->redirectToRoute('adresse_new');

        }
        $form = $this->createForm(CheckoutFormType::class,null,['user'=>$user]);

        $form->handleRequest($request);


        return $this->render('checkout/index.html.twig', [
            'cart' => $cart, 'cart' => $cart,
            'total'=> $total,
            'form'=> $form->createView()
        ]);
    }
}
