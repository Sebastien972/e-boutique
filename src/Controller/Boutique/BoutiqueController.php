<?php

namespace App\Controller\Boutique;

use App\Entity\Produit;
use App\Form\ShearchProduitType;
use App\Repository\CategoriesRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoutiqueController extends AbstractController
{
    /**
     * @Route("/boutique", name="boutique_controllze")
     * @param ProduitRepository $produitRepository
     * @param CategoriesRepository $categoriesRepository
     * @param Request $request
     * @param Produit $produits
     * @return Response
     */
    public function index(ProduitRepository $produitRepository, CategoriesRepository $categoriesRepository, Request $request): Response
    {
        $form = $this->createForm(ShearchProduitType::class);
        $limit = 8;
        $page = (int)$request->query->get('page', 1);
        $filters = $request->get('categorie');
        $total = $produitRepository->getTotalProduit($filters);
        // dd($total);
        $search = $form->handleRequest($request);
        $recherche = $search->get('mots')->getData();

        
        $produit = $produitRepository->getPaginatedProduit($page, $limit, $filters);
       
        $categorie = $categoriesRepository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $produit = $produitRepository->search($recherche);
        }
       if ($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('boutique_controllze/_boutique.html.twig', compact( 'produit' , 'page', 'limit', 'total'))
            ]);

        }

        return $this->render('boutique_controllze/index.html.twig', [
            'produit' => $produit,
            'categorie' => $categorie,
            'page' => $page,
            'total' => $total,
            'limit' => $limit,
            'form' => $form->createView()
        ]);
    }
}
