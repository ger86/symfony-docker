<?php

namespace App\CustomHelper\Web;

use App\Document\Design\DesignDocument;
use App\Document\Web\WebDocument;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebHelper extends AbstractController
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }
    public function saveWeb($web):string|bool{
       try {
        $newWeb = new WebDocument();
        $newWeb->setTitle($web['title']);
        $newWeb->setPorcent($web['Porcents']);
         
        $this->dm->persist($newWeb);
        $this->dm->flush();

        return  !$newWeb->getId()? false : true ;
       } catch (\Throwable $th) {
        return $th;
       }
       
    }

    public function getWeb() 
    {
        try {
            $outputWeb = [];
            $getWebRepository = $this->dm->getRepository(WebDocument::class);
             $webRepository = $getWebRepository->findAll();
                 
            for ($i = 0; $i < count($webRepository); $i++) {
              
                $outputWeb[$i]['id'] = $webRepository[$i]->getId();
                $outputWeb[$i]['title']  = $webRepository[$i]->getTitle();
                $outputWeb[$i]['porcents']  = $webRepository[$i]->getPorcent();
                
            }
          return new ArrayCollection($outputWeb);
        } catch (\Throwable $th) {
         return $th;
        }
        
     }


     public function deletteweb($id):bool|string
     {
         try { 
            $webRepository = $this->dm->createQueryBuilder(WebDocument::class)
                ->findAndRemove()
                ->field('id')->equals($id)
                ->getQuery()
                ->execute();
 
              return  !$webRepository->getId() ? false : true;
           
         } catch (\Throwable $th) {
          return $th;
         }
         
      }
 

}