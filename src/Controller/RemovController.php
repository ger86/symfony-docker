<?php

namespace App\Controller;

use App\Document\Author;
use App\Document\Books;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RemovController extends AbstractController
{
    /**
     * @Route("/remov/{slug}", name="app_remov")
     */
    public function index(DocumentManager $dm, $slug): Response
    {

        $user = $dm->find(Books::class, $slug);
        // $result = $user->getId();
        $dm->remove($user); 
        $dm->flush();
 

        return $this->render('remov/index.html.twig', [
            'dataToRemove' => $result,
        ]);
    }
}
