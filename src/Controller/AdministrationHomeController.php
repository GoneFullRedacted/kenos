<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdministrationHomeController extends AbstractController
{
    #[Route('/administration/home', name: 'app_administration_home')]
    public function index(): Response
    {
        return $this->render('administration_home/index.html.twig', [
            'controller_name' => 'AdministrationHomeController',
        ]);
    }
}
