<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use Doctrine\ODM\MongoDB\DocumentManager;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="app_test")
     */ 
    public function index(DocumentManager $dm): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
