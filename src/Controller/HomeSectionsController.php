<?php

namespace App\Controller;

use App\Form\PrincipalKnowledge\PrincipalKnowledgeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeSectionsController extends AbstractController
{
    /**
     * @Route("/home/sections", name="app_home_sections")
     */
    public function index(
        Request $request, 
        ): Response
    {

        $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
        if (!$getLoguinStatus) {
            return $this->redirectToRoute("app_home");
        }

        $isActive = 'layourMaker';
        if ($request->query->get('active') != null) {
            switch ($request->query->get('active')) {
                case 'principal_knowledges':
                    $isActive = 'principal_knowledges';
                    break;
                case 'graphicDesign':
                    $isActive = 'graphicDesign';
                    break;
                // case 'PHP':
                //     $isActive = 'PHP';
                //     break;
                // case 'wordPress':
                //     $isActive = 'wordPress';
                //     break;
                // case 'reactJS':
                //     $isActive = 'reactJS';
                //     break;

                // case 'webPack':
                //     $isActive = 'webPack';
                //     break;
                // case 'hubSpot':
                //     $isActive = 'hubSpot';
                //     break;
            }
        }

        $PrincipalKnowledgeType = $this->createForm(PrincipalKnowledgeType::class);


    //   dd($languaje->getAllLanguaje());

        return $this->render('home_sections/index.html.twig', [
             'active'                     => $isActive,
             'PrincipalKnowledgeType'     => $PrincipalKnowledgeType->createView() 
        ]);
    }
}
