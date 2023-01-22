<?php

namespace App\CustomHelper\Design;

use App\Document\Design\DesignDocument;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DesignHelper extends AbstractController
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }
    public function saveDesign($design):string|bool{
       try {
        $newDesign = new DesignDocument();
        $newDesign->setTitle($design['title']);
        $newDesign->setYear($design['year']);
         
        $this->dm->persist($newDesign);
        $this->dm->flush();

        return  !$newDesign->getId()? false : true ;
       } catch (\Throwable $th) {
        return $th;
       }
       
    }

    public function getDesign() 
    {
        try {
            $outputDesign = [];
            $getDesignRepository = $this->dm->getRepository(DesignDocument::class);
             $designRepository = $getDesignRepository->findAll();
                 
            for ($i = 0; $i < count($designRepository); $i++) {
              
                $outputDesign[$i]['id'] = $designRepository[$i]->getId();
                $outputDesign[$i]['title']  = $designRepository[$i]->getTitle();
                $outputDesign[$i]['year']  = $designRepository[$i]->getYear();
                
            }
          return new ArrayCollection($outputDesign);
        } catch (\Throwable $th) {
         return $th;
        }
        
     }


     public function deletteDesign($id):bool|string
     {
         try { 
            $designRepository = $this->dm->createQueryBuilder(DesignDocument::class)
                ->findAndRemove()
                ->field('id')->equals($id)
                ->getQuery()
                ->execute();
 
              return  !$designRepository->getId() ? false : true;
           
         } catch (\Throwable $th) {
          return $th;
         }
         
      }
 

}