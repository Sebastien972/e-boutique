<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CGUtilisateurController extends AbstractController
{
    /**
     * @Route("/c/g/utilisateur", name="c_g_utilisateur")
     */
    public function index(): Response
    {
        return $this->render('cg_utilisateur/index.html.twig', [
            'controller_name' => 'CGUtilisateurController',
        ]);
    }
}
