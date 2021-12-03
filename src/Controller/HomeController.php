<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use http\Env\Request;
use phpDocumentor\Reflection\Types\This;
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
           // dd([$produit, $meilleurVente]);
        return $this->render('home/index.html.twig', [
            'meilleurVente' => $meilleurVente,
            'infoProduit' => $produit
        ]);
    }


    /**
     * @Route("/produit/{slug}", name="produit")
     * @param Produit $produit
     * @return Response
     */
    public function produit(?Produit $produit):Response
    {
        if (!$produit){
            return $this->redirectToRoute("home");
        }

        return $this->render('home/produit.html.twig', [
            'produit'=>$produit,
        ]);
    }
}
