<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mk_admin")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="mk_dashboard")
     */
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }
}
