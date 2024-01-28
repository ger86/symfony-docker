<?php

namespace App\Controller\Pages;

// use App\CustomHelper\Post\SavePost;

use App\CustomHelper\Page\DelettePage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DelettePageController extends AbstractController 
{

  private $status; 
 

  public function __construct()
  {
    $this->status = false; 
  }

 
 /** 
  * @Route("/page/delettepage", name="app_delettetpage")
 */
 public function index(Request $request, DelettePage $delettePage): Response
 {

   

    $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
    if (!$getLoguinStatus) {
      return $this->redirectToRoute("app_home");
    }
      
         try {
           if( $request->query->get("type") == 'delette' && $request->query->get("pageId")){
               $this->status = $delettePage->delettePage($request->query->get("pageId"));
           }
         } catch (\Throwable $error) {
          $this->status = $error;
         }
     
    return $this->redirectToRoute('app_listpage');
 }
}
?>