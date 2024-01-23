<?php

namespace App\Controller\Pages;

// use App\CustomHelper\Post\SavePost;

use App\CustomHelper\Page\SavePage;
use App\Document\PageDocument\Page; 
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListPageController extends AbstractController 
{

  private $status;

  public function __construct()
  {
    $this->status= false;
  }

 
 /** 
  * @Route("/page/listpage", name="app_listpage")
 */
 public function index(Request $request, DocumentManager $dm, SavePage $savepage): Response
 {

    $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
    if (!$getLoguinStatus) {
      return $this->redirectToRoute("app_home");
    }

   
    try {
      if ("array" == getType($request->request->get("page"))) { 
        $this->status = $savepage->getDataToSavePageInDatabase($request->request->get("page"));
      }
     } catch (\Throwable $e) {
      dd($e);
    }




    $allpages = $dm->getRepository(Page::class)->findAll();
 
    return $this->render('listpage/index.html.twig', [
    'status'       => $this->status, 
    'pageList'     => $allpages,
      ]); 
 }
}
?>