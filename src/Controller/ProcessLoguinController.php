<?php

namespace App\Controller;

use App\Document\Userone;
use App\Event\LoguinEvents;
use App\Events\Loguinevent;
use App\Form\Loguin;
use Doctrine\Common\EventManager;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProcessLoguinController extends AbstractController
{ 
    /**
     * @Route("/processloguin", name="app_process_loguin")
     */
    public function index(Request $request,
    DocumentManager $dm): Response
    {
         

        $form = $this->createForm(Loguin::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
          
        $values = ['email' => $form->getData()['email'],
                  'mipass' => md5($form->getData()['password'])];
           
        $geturser = $dm->getRepository(Userone::class)
        ->findOneBy($values);
            
     
            if($geturser){
                $evm = new EventManager();
                 $test = new LoguinEvents($evm);
                $evm->dispatchEvent(Loguinevents::LogueIn);
                
                return $this->redirectToRoute("app_pannels");
            
                } else {
                $errorMensaje = ['mensaje' => '😔 Revisa las credenciales subministradas.'];
                return $this->redirectToRoute("app_home", $errorMensaje , 302);
            } 

        }
    }
}
