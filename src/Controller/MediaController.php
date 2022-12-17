<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediaController extends AbstractController
{
    /**
     * @Route("/media", name="app_media")
     */
    public function index(): Response
    {
        return $this->render('media/index.html.twig');
    }
}
