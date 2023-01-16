<?php

namespace App\Controller\Home;

use App\CustomHelper\GetKnowledges\GetSingleKnowlegeByid;
use App\CustomHelper\Homehelper\Saveknowledge;
use App\Form\PrincipalKnowledge\PrincipalKnowledgeType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeSectionsController extends AbstractController
{
    private $dm; 

    public function __construct(DocumentManager $dm)
    { 
        $this->dm = $dm;   
    }

    /**
     * @Route("/home/sections", name="app_home_sections")
     */
    public function index(
        Request $request, 
        GetSingleKnowlegeByid $knowlegeById
        ): Response
    {

        $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
        if (!$getLoguinStatus) {
            return $this->redirectToRoute("app_home");
        }
  
        $status = null;
        $isActive = 'principal_knowledges';
        if ($request->query->get('active') != null) {
            switch ($request->query->get('active')) {
               
                case 'principal_knowledges':
                   
                    $isActive = 'principal_knowledges';
                    if('principal_knowledges' == $request->query->get('savetype') ){
                     
                        $saveKnowledge = new Saveknowledge();
                        $saveKnowledgeResult = $saveKnowledge->saveKnowledgeInDatabase($this->dm, $request->request->get('principal_knowledge'));
                        
                        if(true == $saveKnowledgeResult && 'boolean' == getType($saveKnowledgeResult))
                        {
                            $status = '✨ knowledge Saved Suscessfully';
                        } else {
                            $status = '🤬 '.$saveKnowledgeResult;
                        }
                    }

                    if('eddit_knowledges' == $request->query->get('savetype') ){
                        // dd($request->request->all()["principal_knowledge"]);
                        $edditKnowledge = new Saveknowledge();
                        $edditKnowledgeResult = $edditKnowledge->edditKnowledgeInDatabase($this->dm, $request->request->all()["principal_knowledge"]);
                        //    dd(getType($edditKnowledgeResult));
                        if('1' == $edditKnowledgeResult  && "string" == getType($edditKnowledgeResult))
                        {
                            $status = '✨ knowledge Eddited Suscessfully';
                        } else {
                            $status = '🤬 '. $edditKnowledgeResult ;
                        }
                    }
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

        $PrincipalKnowledgeType = $this->createForm(PrincipalKnowledgeType::class, null, [
            'attr' =>  $request->query->get('active') == 'editDataKnowledge' ? 
            $knowlegeById->returnKnowledge(
                $request->query->get('id'),
                $request->query->get('lang')
                )[0] : []
        ]);

       $edditing = $request->query->get('active') == 'editDataKnowledge' ? true : false;
       
        return $this->render('home_sections/index.html.twig', [
             'active'                     => $isActive,
             'PrincipalKnowledgeType'     => $PrincipalKnowledgeType->createView(),
             'status'                     => $status,
             'edditing'                   =>  $edditing 
        ]);
    }
}
