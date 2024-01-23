<?php

namespace App\CustomHelper\Page;

 
use App\Document\PageDocument\Page;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
 

class SavePage extends AbstractController
{    
    private $dm; 

    public function __construct( DocumentManager $dm )
    {
        $this->dm = $dm;  
    
    }

    
    public function getDataToSavePageInDatabase($pageData): bool
    {
      
  
         $newPage = new Page();
         
          $newPage->setTitle($pageData["title"]);
          $newPage->setImageUrl($pageData["heroImage"]);
          $newPage->setBody($pageData["htmlarea"]);
         
          $this->dm->persist($newPage);
          $this->dm->flush();
        
          $result = $newPage->getId() != null ? true : false ;
             return $result;
        } 
    }
 