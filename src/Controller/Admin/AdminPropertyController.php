<?php

namespace App\Controller\Admin;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
    /**
     * @var ProduitRepository
     */
    private $repository;

    public function __construct(ProduitRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * @Route("/admin/admin/property", name="admin_admin_property")
     */
    public function index(ProduitRepository $produitRepository): Response
    {

        $property = $this->repository->findAll();
        return $this->render('admin/admin_property/index.html.twig', [
            'catégorie'=>$produitRepository->findAll(),
        ]);
    }
}
