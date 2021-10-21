<?php

namespace App\Controller;

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
    public function index(): Response
    {
        return $this->render('account_user/index.html.twig');
    }
}
