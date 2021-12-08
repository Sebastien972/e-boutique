<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Produit;
use App\Entity\Transporteurs;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Boutique');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('produit', 'fas fa-list', Produit::class);
        yield MenuItem::linkToCrud('categirie', 'fas fa-list', Categories::class);
        yield MenuItem::linkToCrud('user', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Transporteur', 'fas fa-truck', Transporteurs::class);
    }
}
