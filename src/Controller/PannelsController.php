<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PannelsController extends AbstractController
{
    /**
     * @Route("/pannels", name="app_pannels")
     */
    public function index(Request $request): Response
    {
        
       
        $getLoguinStatus = intval( $request->cookies->get( $_ENV['SECRETNAME_KOOKIE'] ) ); 
         if( !$getLoguinStatus )
         {
          return $this->redirectToRoute("app_home");
         }

        return $this->render('pannels/index.html.twig', [
            'controller_name' => 'PannelsController',
        ]);
    }
}
