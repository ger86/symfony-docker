<?php

namespace App\Controller\Pages;

// use App\CustomHelper\Post\SavePost;

use App\CustomHelper\Page\GetDataPage;
use App\CustomHelper\Page\SavePageEdited;
use App\Document\PageDocument\Page;
use App\Form\Page\EdditPageType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EdditPageController extends AbstractController 
{

  private $status;
  private $pageDataForEddit;
 

  public function __construct()
  {
    $this->status = false; 
  }

 
 /** 
  * @Route("/page/edditpage", name="app_edditpage")
 */
 public function index(Request $request, DocumentManager $dm, GetDataPage $getDataPage, SavePageEdited $savePageEdited): Response
 {

   

    $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
    if (!$getLoguinStatus) {
      return $this->redirectToRoute("app_home");
    }
     
        
    try {
        switch ($request->query->get("type")) {
          case 'eddit':
            if ( $request->query->get("pageId")) { 
              $this->pageDataForEddit = $getDataPage->getDataFromPageDatabase($request->query->get("pageId"))->toArray(); 
              }
            break;
            case 'save': 
              $this->status = $savePageEdited->getDataToSavePageEditedInDatabase($request->request->get("eddit_page"))[1];
              $this->pageDataForEddit = $savePageEdited->getDataToSavePageEditedInDatabase($request->request->get("eddit_page"))[0];
              break;
          
          default:
            # code...
            break;
        }
 
     } catch (\Throwable $e) {
      dd($e);
    }
    //  dd( $this->pageDataForEddit);
   
     $get_page_form_for_eddit = $this->createForm(EdditPageType::class, null, [ 
      'attr' => $this->pageDataForEddit,
     ]);

     
    return $this->render('edditpage/index.html.twig', [
     'status'       => $this->status,  
     'pageFormData' => $get_page_form_for_eddit->createView(),
      ]); 
 }
}
?>