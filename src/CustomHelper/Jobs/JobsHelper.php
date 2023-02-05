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

    public function getJobs() 
    {
        try {
            $outputJobs = [];
            $getJobsRepository = $this->dm->getRepository(JobsDocument::class);
             $jobsRepository = $getJobsRepository->findAll();
                 
            for ($i = 0; $i < count($jobsRepository); $i++) {
              
                $outputJobs[$i]['id'] = $jobsRepository[$i]->getId();
                $outputJobs[$i]['dateName']  = $jobsRepository[$i]->getDatename();
                $outputJobs[$i]['title']  = $jobsRepository[$i]->getTitle();
                $outputJobs[$i]['description']  = $jobsRepository[$i]->getDescription();
                $outputJobs[$i]['lang']  = $jobsRepository[$i]->getLanguaje()->getLanguaje();
                
            }
          return new ArrayCollection($outputJobs);
        } catch (\Throwable $th) {
         return $th;
        }
        
     }

     public function returnJobs(string $id, string $lang) 
     {
         try {
             $outputJobs = [];
             $getJobsRepository = $this->dm->getRepository(JobsDocument::class);
              $jobsRepository = $getJobsRepository->findBy(['id' => $id]);
                  
             for ($i = 0; $i < count($jobsRepository); $i++) {
               
                 $outputJobs[$i]['id'] = $jobsRepository[$i]->getId();
                 $outputJobs[$i]['dateName']  = $jobsRepository[$i]->getDatename();
                 $outputJobs[$i]['title']  = $jobsRepository[$i]->getTitle();
                 $outputJobs[$i]['description']  = $jobsRepository[$i]->getDescription();
                 $outputJobs[$i]['lang']  = $jobsRepository[$i]->getLanguaje()->getLanguaje();
                 
             }
            //    dd($outputJobs);
           return $outputJobs;
         } catch (\Throwable $th) {
          return $th;
         }
         
      }
     

      public function edditJobs(array $jobs){
        try {
           
                $languaje = $this->dm->getRepository(Languajes::class)->findOneBy(
                  ['languaje' => $jobs['languaje']]
                );
          
                $resultJobEddited = $this->dm->createQueryBuilder(JobsDocument::class)
                  ->updateOne()
                  ->field('datename')->set($jobs['datename'])
                  ->field('title')->set($jobs['title'])
                  ->field('description')->set($jobs['htmlarea'])
                  ->field('languaje')->set($languaje)
                  ->field('_id')->equals($jobs['id'])
                  ->getQuery()
                  ->execute();
          
                return $resultJobEddited->getModifiedCount();

            } catch (\Throwable $th) {
              return  $th;
        }
      }


     public function delettejobs($id):bool|string
     {
         try { 
            $jobRepository = $this->dm->createQueryBuilder(JobsDocument::class)
                ->findAndRemove()
                ->field('id')->equals($id)
                ->getQuery()
                ->execute();
 
              return  !$jobRepository->getId() ? false : true;
           
         } catch (\Throwable $th) {
          return $th;
         }
         
      }
 

}