<?php

namespace App\CustomHelper\Page;

 
use App\Document\PageDocument\Page;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
 

class GetDataPage extends AbstractController
{    
    private $dm; 
    public $pageValues = [];

    public function __construct( DocumentManager $dm )
    {
        $this->dm = $dm;  
    
    }

    
    public function getDataFromPageDatabase($pageId): ArrayCollection
    {
       
   $dm = $this->dm;
        
   try {

     $getPageForEddit = $dm->find(Page::class, $pageId); 
     $this->pageValues['id'] = $getPageForEddit->getId();
     $this->pageValues['title'] = $getPageForEddit->getTitle();
     $this->pageValues['heroImage'] = $getPageForEddit->getImageUrl();
     $this->pageValues['htmlarea'] = $getPageForEddit->getBody();  
     return new ArrayCollection( $this->pageValues );

     
   } catch (\Throwable $error) {
    dd($error);
   }
    
   
        } 
    }
 