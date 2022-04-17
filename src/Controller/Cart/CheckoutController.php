<?php

namespace App\Controller\Cart;

use App\Form\CheckoutFormType;
use App\Services\CartServices;
use App\Services\OrderServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    private $cartServices;
    private $session;

    function __construct(CartServices $cartServices, SessionInterface $session)
    {
        $this->session = $session;
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
        // $total = $this->cartServices->getTotalCart();

        if (empty($cart)){
           return $this->redirectToRoute('home');
        }
        if ($user == null){
            $this->addFlash('checkout_message', 'vous devez vous connecter a pour continuer');

            return $this->redirectToRoute('app_login');
         }
        
        if (empty($user->getAdresses()->getValues())){
            $this->addFlash('checkout_message', 'vous devez ajouter une adresse pour continuer');
            return $this->redirectToRoute('adresse_new');

        }
        if($this->session->get('checkout_data'))
        {
            return $this->redirectToRoute('checkout_confirm');

        }

            $form = $this->createForm(CheckoutFormType::class,null,['user' => $user]);

        $form->handleRequest($request);


        return $this->render('checkout/index.html.twig', [
            'cart' => $cart,
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/checkout/confirm", name="checkout_confirm")
     */
    public function checkConfirm(Request $request, OrderServices $orderServices)
    {
        $user = $this->getUser();

        $cart = $this->cartServices->getFullCart();

        if (empty($cart)){
            return $this->redirectToRoute('home');
        }
        if (empty($user->getAdresses()->getValues())){
            $this->addFlash('checkout_message', 'vous devez ajouter une adresse pour continuer');
            return $this->redirectToRoute('adresse_new');

        }
        $form = $this->createForm(CheckoutFormType::class,null,['user' => $user]);
        // dd($cart);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() || $this->session->get('checkout_data'))
        {

            if ($this->session->get('checkout_data')){
                $data = $this->session->get('checkout_data');
            }else{
                $data = $form->getData();
                $this->session->set('checkout_data', $data);
            }
            $adresse = $data['adresse'];
            $transporteur = $data['transporteur'];
            $info = $data['information'];
            $cart['checkout'] = $data;
            // dd($cart);
            $ref = $orderServices->saveCart($cart, $user);
            // dd($ref);
            return $this->render('checkout/confirm.html.twig', [
                'cart' => $cart,
                'adresse'=>$adresse,
                'transporteur' => $transporteur,
                'info'=>$info,
                'form'=> $form->createView(),
                'ref'=>$ref,
            ]);
        }
        return $this->redirectToRoute('checkout');
    }

    /**
     * @Route ("/checkout/edit", name="checkout_edit")
     */
    public function checkoutEdit()
    {
        $this->session->set('checkout_data',[]);
       return $this->redirectToRoute('checkout');
    }


}
