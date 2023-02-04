<?php

namespace App\CustomHelper\Works;

use App\Document\Languajes;
use App\Document\SomeWorks\SomeWorksDocument;
use App\Document\Web\WebDocument;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WorksHelper extends AbstractController
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }
    public function saveWorks($works):string|bool{
       
       try {
        $languaje = $this->dm->getRepository(Languajes::class)->findOneBy(
            ['languaje' => $works['languaje']]
          );
        //   dd($languaje);
        $newWorks = new SomeWorksDocument;
        $newWorks->setBase($works['base']);
        $newWorks->setTechs($works['techs']);
        $newWorks->setDescription($works['htmlarea']);
        $newWorks->setLanguaje($languaje);
         
        $this->dm->persist($newWorks);
        $this->dm->flush();

        return  !$newWorks->getId()? false : true ;
       } catch (\Throwable $th) {
        return $th;
       }
       
    }

    public function getWorks() 
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


     public function deletteWorks($id):bool|string
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
 