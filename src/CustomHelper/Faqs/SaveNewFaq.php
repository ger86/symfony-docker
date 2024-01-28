<?php

namespace App\CustomHelper\Faqs;

use App\Document\Faqs\Faqs;  
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
 

class SaveNewFaq extends AbstractController
{    
    private $dm; 

    public function __construct( DocumentManager $dm )
    {
        $this->dm = $dm;  
    
    }

    
    public function getDataToSaveFaqInDatabase($FaqData): bool
    { 
         $newFaq = new Faqs();
         
          $newFaq->setQuestion($FaqData["question"]);
          $newFaq->setResponse($FaqData["response"]); 
         
          $this->dm->persist($newFaq);
          $this->dm->flush();
        
          $result = $newFaq->getId() != null ? true : false ;
          return $result;
        } 
    }
 