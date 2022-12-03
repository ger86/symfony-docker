<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PannelsController extends AbstractController
{
    /**
     * @Route("/pannels", name="app_pannels")
     */
    public function index(): Response
    {
        return $this->render('pannels/index.html.twig', [
            'controller_name' => 'PannelsController',
        ]);
    }
}
