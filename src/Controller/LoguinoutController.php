<?php

namespace App\Controller;

use App\Event\LoguinEvents;
use Doctrine\Common\EventManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoguinoutController extends AbstractController
{
    /**
     * @Route("/logout", name="app_logout")
     */
    public function index(Request $request): Response
    { 
        $evm = new EventManager();
        $test = new LoguinEvents($evm);
       $evm->dispatchEvent(Loguinevents::loguedOut);
   
       if(!$request->cookies->get($_ENV['SECRETNAME_KOOKIE'])){
         return $this->redirectToRoute("app_home"); 
       } 
       return $this->redirectToRoute("app_pannels"); 
    }
}
