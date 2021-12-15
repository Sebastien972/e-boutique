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
    private $cartServices;

    function __construct(CartServices $cartServices)
    {
        $this->cartServices = $cartServices;
    }
    /**
     * @Route("/checkout", name="checkout")
     * @param CartServices $cartServices
     * @param Request $request
     * @return Response
     */
    public function index( Request $request): Response
    {
        $user = $this->getUser();

        $cart = $this->cartServices->getFullCart();
        $total = $this->cartServices->getTotalCart();

        if (empty($cart)){
           return $this->redirectToRoute('home');
        }
        if (empty($user->getAdresses()->getValues())){
            $this->addFlash('checkout_message', 'vous devez ajouter une adresse pour continuer');
            return $this->redirectToRoute('adresse_new');

        }
        $form = $this->createForm(CheckoutFormType::class,null,['user' => $user]);

        $form->handleRequest($request);


        return $this->render('checkout/index.html.twig', [
            'cart' => $cart,
            'total'=> $total,
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/checkout/confirm", name="checkout_confirm")
     */
    public function checkConfirm(Request $request)
    {
        $user = $this->getUser();

        $cart = $this->cartServices->getFullCart();
        $total = $this->cartServices->getTotalCart();

        if (empty($cart)){
            return $this->redirectToRoute('home');
        }
        if (empty($user->getAdresses()->getValues())){
            $this->addFlash('checkout_message', 'vous devez ajouter une adresse pour continuer');
            return $this->redirectToRoute('adresse_new');

        }
        $form = $this->createForm(CheckoutFormType::class,null,['user' => $user]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $adresse = $data['adresse'];
            $transporteur = $data['transporteur'];
            $info = $data['information'];
            return $this->render('checkout/confirm.html.twig', [
                'cart' => $cart,
                'total'=> $total,
                'adresse'=>$adresse,
                'transporteur' => $transporteur,
                'info'=>$info,
                'form'=> $form->createView(),
            ]);
        }
        return $this->redirectToRoute('checkout');
    }




}
