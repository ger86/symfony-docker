<?php

namespace App\Controller\Home\Web;

use App\CustomHelper\Web\WebHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeWebListController extends AbstractController
{
    /**
     * @Route("/web/list", name="app_home_web_list")
     */
    public function index(
        Request $request, 
        WebHelper $webHelper
    ): Response
    {
        $getLoguinStatus = intval(
            $request->cookies->get($_ENV['SECRETNAME_KOOKIE'])
        );
        if (!$getLoguinStatus) {
            return $this->redirectToRoute('app_home');
        }
        

        if ($request->query->get('active') != null) {
            switch ($request->query->get('active')) {
                case 'deletteWeb' :
                 
                     $rsultWeb = $webHelper->deletteweb( $request->query->get('id') );
                    // redirect here
                    if(!$rsultWeb ){
                        dd($rsultWeb);
                    }
                 
                break;
            }
        }


        return $this->render('web_list/index.html.twig', [
            'webList' => $webHelper->getWeb()
        ]);
    }
}
