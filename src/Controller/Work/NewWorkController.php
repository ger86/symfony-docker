<?php

namespace App\Controller\Work;

use App\CustomHelper\work\WorkHelper;
use App\Feching\Fetchdata;
use App\Form\Work\WorkType; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewWorkController extends AbstractController 
{ 
    private $status;

    public function __construct()
    {
      $this->status = false;
    }
  
   
   /** 
    * @Route("/work/newWork", name="app_newWork")
   */
   public function index(Request $request, WorkHelper $saveWork, Fetchdata $fetchdata): Response
   {
    
     $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
     if (!$getLoguinStatus) {
       return $this->redirectToRoute("app_home");
     }

     try {
        
       if ("array" == getType($request->request->get("work"))) { 
          $this->status = $saveWork->saveWork($request->request->get("work"));
       }
      } catch (\Throwable $e) {
       dd($e);
     }

     $imageBank = $fetchdata->fetchGitHubInformation();

       $form = $this->createForm(WorkType::class);

       return $this->render('work/newWork/index.html.twig', [
         'status'       => $this->status,
         'mediaElement' => $imageBank,
         'workform'  => $form->createView(),
       ]);
   }
}