<?php

namespace App\Controller;

use App\Form\LanguajeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetadataController extends AbstractController
{
    /**
     * @Route("/metadata", name="app_metadata")
     */
    public function index(Request $request): Response
    {
        $getLoguinStatus = intval( $request->cookies->get( $_ENV['SECRETNAME_KOOKIE'] ) ); 
       if( !$getLoguinStatus )
       {
         return $this->redirectToRoute("app_home");
        } 

        $form = $this->createForm(LanguajeType::class);
        return $this->render('metadata/index.html.twig', [
            'LanguajeForm' =>  $form->createView(),
        ]);
    }
}
