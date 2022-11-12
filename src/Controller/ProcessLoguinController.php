<?php

namespace App\Controller;

use LDAP\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProcessLoguinController extends AbstractController
{
    /**
     * @Route("/processloguin", name="app_process_loguin")
     */
    public function index(): Response
    {

       $geco = array('result'=> $_GET['test']);
         return $this->redirectToRoute("app_home", $geco);
        //  return new Response('worl');
    }
}
