<?php

namespace App\Controller\UserAccount;

use App\Entity\Commande;
use App\Repository\AdresseRepository;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AccountUserController
 * @package App\Controller
 * @Route("/account")
 */
class AccountUserController extends AbstractController
{
    /**
     * @Route("/user", name="account_user")
     */
    public function index(AdresseRepository $adresseRepository,CommandeRepository $commandeRepository): Response
    {

        $commande = $commandeRepository->findBy(['isPaid'=> true, 'user'=>$this->getUser()]);
        // dd($commande);
        return $this->render('account_user/index.html.twig' , [
            'adresse' => $adresseRepository->findAll(),
            'commande'=> $commande,
        ]);
    }
    /**
     * @Route("/user/commande{id}", name="commande_user")
     */
    public function commande(?Commande $commande)
    {
        if (!$commande || $this->getUser() !== $commande->getUser() || !$commande->getIsPaid) {
            return $this->redirectToRoute('home');
        }
        // dd($commande);
        return $this->render('account_user/commande.html.twig' , [
            'commande'=> $commande,
        ]);
    }
}
