<?php

namespace App\CustomHelper\Page;

 
use App\Document\PageDocument\Page;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
 

class SavePageEdited extends AbstractController
{    
    private $dm; 

    public function __construct( DocumentManager $dm )
    {
        $this->dm = $dm;  
    
    }
 
    public function getDataToSavePageEditedInDatabase($pageData): Array
    {  

        try {
            $resultUpdatedPage = $this->dm->createQueryBuilder(Page::class)
            ->updateOne()
            ->field('title')->set($pageData["title"])
            ->field('imageUrl')->set($pageData["heroImage"])
            ->field('body')->set($pageData["htmlarea"])
            ->field('_id')->equals($pageData["id"]) 
            ->getQuery()->execute();

         $result = $resultUpdatedPage->getModifiedCount() == 1 ? true : false;  

            return [$pageData, $result];

        } catch (\Throwable $error) {
            dd($error);
        }
      
        } 
    }
 