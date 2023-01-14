<?php

namespace App\CustomHelper\Homehelper;

use App\Document\Homedata\Principalknowledge;
use App\Document\Languajes;  
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class Saveknowledge extends AbstractController
{    
    
    
    public function saveKnowledgeInDatabase($dm, array $knowledge): string|bool
    {
    
         
        try {
            $languaje = $dm->getRepository(Languajes::class)->findOneBy(
                ['languaje' => $knowledge['languaje']]
              ); 
             $newKnowledge = new Principalknowledge();
             $newKnowledge->setTitle($knowledge['title']);
             $newKnowledge->setBody($knowledge['htmlarea']);
             $newKnowledge->setLanguaje($languaje);
              $dm->persist($newKnowledge);
              $dm->flush();
            
              $result = $newKnowledge->getId() != null ? true : false ;
              return $result;
        } catch (\Throwable $th) {
            return $th;
        }
         
           
        } 
    }