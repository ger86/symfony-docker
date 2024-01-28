<?php

namespace App\Controller\Faqs;

// use App\CustomHelper\Post\SavePost;

use App\CustomHelper\Faqs\DeletteFaqs; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeletteFaqsController extends AbstractController 
{

  private $status; 
 

  public function __construct()
  {
    $this->status = false; 
  }

 
 /** 
  * @Route("/faqs/delettefaqs", name="app_delettetfaqs")
 */
 public function index(Request $request, DeletteFaqs $deletteFaq): Response
 {

   

    $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
    if (!$getLoguinStatus) {
      return $this->redirectToRoute("app_home");
    }
    
         try {
           if( $request->query->get("type") == 'delette' && $request->query->get("id")){
               $this->status = $deletteFaq->deletteFaq($request->query->get("id"));
           }
         } catch (\Throwable $error) {
          $this->status = $error;
         }
     
    return $this->redirectToRoute('app_listfaqs');
 }
}
?>