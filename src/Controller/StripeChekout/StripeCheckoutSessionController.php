<?php

namespace App\Controller\StripeChekout;

use App\Entity\Cart;
use App\Entity\User;
use App\Services\CartServices;
use App\Services\OrderServices;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeCheckoutSessionController extends AbstractController
{
    /**
     * @Route("/creat-checkout-session{reference}", name="stripe_checkout_session")
     */
    public function index(?Cart $cart, OrderServices $orderServices, EntityManagerInterface $manager): Response
    {

      $user = $this->getUser();
        Stripe::setApiKey('sk_test_51KlrNSD3MEvfjgmfWansXdy1TTlZWzSYtZfgasynz2Qd1O8ClrkEnHmZ4yuQBFx0Zh4Kk26WCQsKDzGxFZ6Vo7Ui00asiZGBqp');
        if (!$cart) {
         return $this->redirectToRoute('home');
        }
        $order = $orderServices->creatOrder($cart); 
        $line_items = $orderServices->getLineItemes($cart);
        
        $checkout_session = Session::create([
          'customer_email' => $user->getEmail(),
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => $_ENV['YOUR_DOMAIN'] . '/stripe-success-payment/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $_ENV['YOUR_DOMAIN'] . '/stripe-cancel-payment/{CHECKOUT_SESSION_ID}',
          ]);
         $order->setStripeCheckoutSessionId($checkout_session->id);
          $manager->flush();
          // dd($order);
        return $this->redirect( $checkout_session->url );
    }
}
