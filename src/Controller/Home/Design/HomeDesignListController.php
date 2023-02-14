<?php

namespace App\Controller\Home\Design;

use App\CustomHelper\Design\DesignHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeDesignListController extends AbstractController
{
    
    /**
     * @Route("/home/design/list", name="app_home_design_list")
     */
    public function index(
        DesignHelper $designhelper,
        Request $request, 
    ): Response
    {
        $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
         if (!$getLoguinStatus) {
             return $this->redirectToRoute("app_home");
         }
         
        // $isActive;
        if ($request->query->get('active') != null) {
            switch ($request->query->get('active')) {
                case 'deletteDesign' :
                 
                     $rsultDesign = $designhelper->deletteDesign( $request->query->get('id') );
                    // redirect here
                    if(!$rsultDesign ){
                        dd($rsultDesign);
                    }
                 
                break;
            }
        }
 
        return $this->render('design_list/index.html.twig', [
            'designs' => $designhelper->getDesign(),
            
        ]);
    }
}