<?php

namespace App\CustomHelper\Works;

use App\Document\Languajes;
use App\Document\SomeWorks\SomeWorksDocument; 
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
            $outputWorks = [];
            $getWorksRepository = $this->dm->getRepository(SomeWorksDocument::class);
             $worksRepository = $getWorksRepository->findAll();
                 
            for ($i = 0; $i < count($worksRepository); $i++) {
                $outputWorks[$i]['id'] = $worksRepository[$i]->getId();
                $outputWorks[$i]['base']  = $worksRepository[$i]->getBase();
                $outputWorks[$i]['techs']  = $worksRepository[$i]->getTechs();
                $outputWorks[$i]['htmlarea']  = $worksRepository[$i]->getDescription();
                $outputWorks[$i]['languaje']  = $worksRepository[$i]->getLanguaje()->getLanguaje();
            }
          return new ArrayCollection($outputWorks);
        } catch (\Throwable $th) {
         return $th;
        }
     }


     public function returnWork(string $id, string $lang) 
    { 
        try {
             $outputWorks = [];
             $getWorkRepository = $this->dm->getRepository(SomeWorksDocument::class);
              $WorksRepository = $getWorkRepository->findBy(['id' => $id]); 
             for ($i = 0; $i < count($WorksRepository); $i++) { 
                 $outputWorks[$i]['id'] = $WorksRepository[$i]->getId();
                 $outputWorks[$i]['base']  = $WorksRepository[$i]->getBase();
                 $outputWorks[$i]['techs']  = $WorksRepository[$i]->getTechs();
                 $outputWorks[$i]['htmlarea']  = $WorksRepository[$i]->getDescription();
                 $outputWorks[$i]['lang']  = $WorksRepository[$i]->getLanguaje()->getLanguaje();
                 
             } 
           return $outputWorks;
         } catch (\Throwable $th) {
          return $th;
         }
     }

     public function edditWorks(array $works){
      try {
        // dd($works);
              $languaje = $this->dm->getRepository(Languajes::class)->findOneBy(
                ['languaje' => $works['languaje']]
              );
        
              $resultJobEddited = $this->dm->createQueryBuilder(SomeWorksDocument::class)
                ->updateOne()
                ->field('base')->set($works['base'])
                ->field('techs')->set($works['techs'])
                ->field('description')->set($works['htmlarea'])
                ->field('languaje')->set($languaje)
                ->field('_id')->equals($works['id'])
                ->getQuery()
                ->execute();
        
              return $resultJobEddited->getModifiedCount();

          } catch (\Throwable $th) {
            return  $th->getMessage();
      }
    }




     public function deletteWorks($id):bool|string
     {
         try { 
            $worksRepository = $this->dm->createQueryBuilder(SomeWorksDocument::class)
                ->findAndRemove()
                ->field('id')->equals($id)
                ->getQuery()
                ->execute();
 
              return  !$worksRepository->getId() ? false : true;
           
         } catch (\Throwable $th) {
          return $th->getMessage();
         }
         
      }
  
}
 