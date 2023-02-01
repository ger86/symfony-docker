<?php

namespace App\CustomHelper\Jobs;

use App\Document\Jobs\JobsDocument;
use App\Document\Languajes;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JobsHelper extends AbstractController
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function saveJop($job):string|bool{
          
       try { 
        $languaje = $this->dm->getRepository(Languajes::class)->findOneBy(
            ['languaje' => $job['languaje']]
          );

        $newJob = new JobsDocument;
     
        $newJob->setDatename($job['datename']);
        $newJob->setTitle($job['title']);
        $newJob->setDescription($job['htmlarea']);
        $newJob->setLanguaje($languaje);
 
        $this->dm->persist($newJob);
         
        $this->dm->flush();
         
        return !$newJob->getId()? false : true ;
       } catch (\Throwable $th) {
        return $th;
       }
       
    }

    // public function getWeb() 
    // {
    //     try {
    //         $outputWeb = [];
    //         $getWebRepository = $this->dm->getRepository(WebDocument::class);
    //          $webRepository = $getWebRepository->findAll();
                 
    //         for ($i = 0; $i < count($webRepository); $i++) {
              
    //             $outputWeb[$i]['id'] = $webRepository[$i]->getId();
    //             $outputWeb[$i]['title']  = $webRepository[$i]->getTitle();
    //             $outputWeb[$i]['porcents']  = $webRepository[$i]->getPorcent();
                
    //         }
    //       return new ArrayCollection($outputWeb);
    //     } catch (\Throwable $th) {
    //      return $th;
    //     }
        
    //  }


    //  public function deletteweb($id):bool|string
    //  {
    //      try { 
    //         $webRepository = $this->dm->createQueryBuilder(WebDocument::class)
    //             ->findAndRemove()
    //             ->field('id')->equals($id)
    //             ->getQuery()
    //             ->execute();
 
    //           return  !$webRepository->getId() ? false : true;
           
    //      } catch (\Throwable $th) {
    //       return $th;
    //      }
         
    //   }
 

}