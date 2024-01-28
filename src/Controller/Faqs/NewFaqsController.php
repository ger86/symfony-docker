<?php

namespace App\Controller\Faqs;

 
use App\CustomHelper\Faqs\SaveNewFaq;
use App\Form\Faqs\FaqsType; 
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewFaqsController extends AbstractController 
{

  private $status;

  public function __construct()
  {
    $this->status= false;
  }

 
 /** 
  * @Route("/faqs/newfaqs", name="app_newfaqs")
 */
 public function index(Request $request, DocumentManager $dm, SaveNewFaq $savenewfaq): Response
 {

    $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
    if (!$getLoguinStatus) {
      return $this->redirectToRoute("app_home");
    }

    
    try {
      if ("array" == getType($request->request->get("faqs"))) { 
         $this->status = $savenewfaq->getDataToSaveFaqInDatabase($request->request->get("faqs"));
      }
     } catch (\Throwable $e) {
      dd($e);
    }

 
      $form = $this->createForm(FaqsType::class);
 
      return $this->render('faqs/newfaq/index.html.twig', [
       'status'       => $this->status,
       'faqform'  => $form->createView(), 
      ]);

 }
}
?>