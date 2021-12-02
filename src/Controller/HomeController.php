<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->findAll();
        $meilleurVente =$produitRepository->findByMeilleurVente(1);
            dd([$produit, $meilleurVente]);
        return $this->render('home/index.html.twig', [
            'meilleurVente' => $meilleurVente,
        ]);
    }
}
