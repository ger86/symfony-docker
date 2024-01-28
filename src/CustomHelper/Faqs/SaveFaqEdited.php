<?php

namespace App\CustomHelper\Faqs;

use App\Document\Faqs\Faqs; 
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
 

class SaveFaqEdited extends AbstractController
{    
    private $dm; 

    public function __construct( DocumentManager $dm )
    {
        $this->dm = $dm;  
    
    }
 
    public function getDataToSaveFaqEditedInDatabase($faqData): bool
    {  

        try {
            $resultUpdatedFaq = $this->dm->createQueryBuilder(Faqs::class)
            ->updateOne()
            ->field('question')->set($faqData["question"])
            ->field('response')->set($faqData["response"]) 
            ->field('_id')->equals($faqData["id"]) 
            ->getQuery()->execute();

         $result = $resultUpdatedFaq->getModifiedCount() == 1 ? true : false;  

            return  $result;

        } catch (\Throwable $error) {
            dd($error);
        }
      
        } 
    }
 