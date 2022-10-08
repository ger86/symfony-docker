<?php

namespace App\Controller;

use App\Document\Albun;
use App\Document\DobleClass;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DobleclassController extends AbstractController
{
    /**
     * @Route("/dobleclass", name="app_dobleclass")
     */
    public function index(DocumentManager $dm): Response
    {
        $dowble = new DobleClass();
        $dowble->setSpace('Room Meetings');
        $dowble->setPrice(55); 

        $albun = new Albun();
        $albun->setAlbun('Only 5 persons');

        $dm->persist($dowble);
        $dm->persist($albun);

        $dm->flush();
 

        return $this->render('dobleclass/index.html.twig', [
            'controller_name' => 'DobleclassController',
        ]);
    }
}
