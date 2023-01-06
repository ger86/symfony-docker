<?php

namespace App\Controller\Blog;

use App\PostHelpper\Helpers\SetDataForEddit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeePostController extends AbstractController
{
    public $filtredPostEdditData = null;
 
    /**
     * @Route("/see/post", name="app_see_post")
     */
    public function index(  
        Request $request,
        SetDataForEddit $SetDataForEddit): Response
    {
         // security
         $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
         if (!$getLoguinStatus) {
             return $this->redirectToRoute("app_home");
         }
 
 
         if ($request->query->get('type')) {
             if('See' == $request->query->get('type')) {
                  $this->filtredPostEdditData =  $SetDataForEddit
                  ->getFiltredDataForFillPostOrShowPost($request->query->get('value'));              
             }
         }
  
        return $this->render('see_post/index.html.twig', [
            'postValue' => $this->filtredPostEdditData
        ]);
    }
}