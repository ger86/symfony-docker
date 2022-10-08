<?php

namespace App\Controller;
use App\Document\Product; 
 use Symfony\Component\Routing\Annotation\Route;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use App\Documents\User;
 use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class productController extends AbstractController
{
    
    
     /**
     * @Route("/mongoTest", name="app_mongoTest")
     */
    
    public function mongoTest(DocumentManager $dm)
    { 
 

        $user = new Product();
         
 
        // $user->setId(003);

    //     $user->setName("Vincent");

    //    $dm->persist($user);
    //     $dm->flush();
    $user = $dm->find(User::class, 2);


        
        return new JsonResponse(array('Status' => $user ));
    }
}