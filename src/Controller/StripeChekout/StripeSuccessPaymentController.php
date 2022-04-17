<?php

namespace App\Controller\StripeChekout;

use App\Entity\Commande;
use App\Services\CartServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeSuccessPaymentController extends AbstractController
{
    /**
     * @Route("/stripe-success-payment/{StripeCheckoutSessionId}", name="stripe_success_payment")
     */
    public function index(Commande $commande, CartServices $cartService, EntityManagerInterface $Manager): Response
    {
        if(!$commande ||$commande->getUser() !== $this->getUser())
        {
            
            return $this->redirectToRoute('home');
        }

        if ($commande->getIsPaid()=== false) {
           $commande->setIsPaid(true);
           $Manager->flush();
        //    dd($commande);
        $cartService->removeAllCart();
        }
        return $this->render('stripe_chekout/stripe_success_payment/index.html.twig', [
            'order' =>$commande,
        ]);
    }
}
