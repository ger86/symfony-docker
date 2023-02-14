<?php 

namespace App\CustomHelper\GetKnowledges;

use App\Document\Homedata\Principalknowledge;
use App\Document\Languajes;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetKnowledgesByLanguajes extends AbstractController
{
    private $dm;

     public function  __construct(DocumentManager $dm){
        $this->dm = $dm;
     }

    public function getKnowlegeByLanguaje($languaje):ArrayCollection
    {
       $getAllknowlege =[];
       $getLanguaje = $this->dm->getRepository(Languajes::class)
         ->findBy(['languaje' => $languaje]);
        
       $knowledge = $this->dm->getRepository(Principalknowledge::class)->findBy([
        'languaje' => $getLanguaje[0]->getId()
       ]);

        for ($i=0; $i < count($knowledge); $i++) { 
             $getAllknowlege[] = ['id'=> $knowledge[$i]->getId(), 'title'=> $knowledge[$i]->getTitle(), 'body'=> $knowledge[$i]->getBody()];
        }
     //  dd( count($knowledge), $knowledge);

         return  new ArrayCollection($getAllknowlege);
    }
}