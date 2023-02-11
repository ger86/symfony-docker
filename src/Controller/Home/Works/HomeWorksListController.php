<?php

namespace App\Controller\Home\Works;

use App\CustomHelper\Works\WorksHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeWorksListController extends AbstractController
{ 
/**
     * @Route("/work/list", name="app_home_works_list")
     */
    public function index(
        Request $request,  
        WorksHelper $worksHelper
    ): Response
    {
        $getLoguinStatus = intval(
            $request->cookies->get($_ENV['SECRETNAME_KOOKIE'])
        );
        if (!$getLoguinStatus) {
            return $this->redirectToRoute('app_home');
        }

        // if ($request->query->get('active') != null) {
        //     switch ($request->query->get('active')) {
        //         case 'deletteWeb' :
                 
        //              $rsultWeb = $worksHelper->getWorks( $request->query->get('id') );
        //             // redirect here
        //             if(!$rsultWeb ){
        //                 dd($rsultWeb);
        //             }
                 
        //         break;
        //     }
        // }
        // dd($worksHelper->getWorks());

        return $this->render('work_list/index.html.twig', [
            'worksList' => $worksHelper->getWorks()
        ]);
    }
}