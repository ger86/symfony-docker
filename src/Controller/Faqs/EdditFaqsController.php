<?php

namespace App\Controller\Faqs;

// use App\CustomHelper\Post\SavePost;

 
 
use App\CustomHelper\Faqs\GetFaqById;
use App\CustomHelper\Faqs\SaveFaqEdited; 
use App\Form\Faqs\EdditFaqType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EdditFaqsController extends AbstractController 
{

  private $status;
  private $getDataForEddit;
 

  public function __construct()
  {
    $this->status = false; 
  }

 
 /** 
  * @Route("/faqs/edditfaqs", name="app_edditfaqs")
 */
 public function index(Request $request, DocumentManager $dm, GetFaqById $getFaqById,  SaveFaqEdited $saveFaqEdited): Response
 {

   

    $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
    if (!$getLoguinStatus) {
      return $this->redirectToRoute("app_home");
    }
    
    
    try {
        switch ($request->query->get("type")) {
          case 'eddit':
            if ( $request->query->get("id")) { 
              $this->getDataForEddit = $getFaqById->getDataFaqFromId($request->query->get("id"))->toArray(); 
              }
            break;
            case 'save': 
              $this->status = $saveFaqEdited->getDataToSaveFaqEditedInDatabase($request->request->get("eddit_faq"));
               
              $this->getDataForEddit = $getFaqById->getDataFaqFromId($request->request->get("eddit_faq")['id'])->toArray(); 
              break;
          
          default:
            # code...
            break;
        }
 
     } catch (\Throwable $e) {
      dd($e);
    }
       
   
     $get_faq_form_for_eddit = $this->createForm(EdditFaqType::class, null, [ 
      'attr' => $this->getDataForEddit,
     ]);

     
    return $this->render('faqs/edditfaq/index.html.twig', [
     'status'       => $this->status,  
     'faqFormData' => $get_faq_form_for_eddit->createView(),
      ]); 
 }
}
?>