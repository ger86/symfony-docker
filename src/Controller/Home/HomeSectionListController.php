<?php

namespace App\Controller\Home;

use App\CustomHelper\GetKnowledges\GetKnowledgesByLanguajes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeSectionListController extends AbstractController
{
    /**
     * @Route("/home/section/list", name="app_home_section_list")
     */
    public function index(Request $request, GetKnowledgesByLanguajes $knowledge): Response
    {

        $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
        if (!$getLoguinStatus) {
            return $this->redirectToRoute("app_home");
        }
 
        return $this->render('home_section_list/index.html.twig', [
            'Knowledge_es' => $knowledge->getKnowlegeByLanguaje('es'),
            'Knowledge_en' =>$knowledge->getKnowlegeByLanguaje('en'),

        ]);
    }
}
