<?php

namespace App\Controller\StripeChekout;

use App\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeCancelPaymentController extends AbstractController
{
    /**
     * @Route("/stripe-cancel-payment{StripeCheckoutSessionId}", name="stripe_cancel_payment")
     */
    public function index(?Commande $commande): Response
    {
        if(!$commande ||$commande->getUser() !== $this->getUser())
        {
            
            return $this->redirectToRoute('home');
        }

        return $this->render('stripe_chekout/stripe_cancel_payment/index.html.twig', [
            'order' => $commande,
        ]);
    }
}
