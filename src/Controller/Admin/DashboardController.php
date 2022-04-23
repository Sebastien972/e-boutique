<?php

namespace App\Controller\Admin;

use App\Entity\Cart;
use App\Entity\Categories;
use App\Entity\Commande;
use App\Entity\Contact;
use App\Entity\Produit;
use App\Entity\Transporteurs;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // return parent::index();
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(CommandeCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Boutique')
            ;
            
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('produit', 'fas fa-list', Produit::class);
        yield MenuItem::linkToCrud('categirie', 'fas fa-list', Categories::class);
        yield MenuItem::linkToCrud('user', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Transporteur', 'fas fa-truck', Transporteurs::class);
        yield MenuItem::linkToCrud('Commande', 'fas fa-truck', Commande::class);
        yield MenuItem::linkToCrud('Cart', 'fas fa-truck', Cart::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-truck', Contact::class);

    }
}
