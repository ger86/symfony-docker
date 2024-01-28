<?php

namespace App\Controller\Faqs;



use App\CustomHelper\Page\DelettePage;
use App\Document\Faqs\Faqs; 
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListFaqsController extends AbstractController 
{

  private $status;

  public function __construct()
  {
    $this->status= false;
  }

 
 /** 
  * @Route("/faqs/listfaqs", name="app_listfaqs")
 */
 public function index(Request $request, DocumentManager $dm, DelettePage $delettePage): Response
 {

    $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
    if (!$getLoguinStatus) {
      return $this->redirectToRoute("app_home");
    }
 
    try { 
      // if( $request->query->get("type") == 'delette' && $request->query->get("pageId")){
      //   $this->status = $delettePage->delettePage($request->query->get("pageId"));
      // }
         $allfaqs = $dm->getRepository(Faqs::class)->findAll();
     } catch (\Throwable $e) {
      dd($e);
    } 

    return $this->render('faqs/faqlist/index.html.twig', [
        'status'       => $this->status, 
         'faqsList'     => $allfaqs,
      ]); 
 }
}



 