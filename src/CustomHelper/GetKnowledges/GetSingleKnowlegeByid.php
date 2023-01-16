<?php

namespace App\CustomHelper\GetKnowledges;

use App\Document\Homedata\Principalknowledge;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;

class GetSingleKnowlegeByid 
{
    private $dm;

    public function  __construct(DocumentManager $dm){
       $this->dm = $dm;
    }
    public function returnKnowledge($id, $lang): ArrayCollection{
       
        $knowledgeData = [];
       $knowledge = $this->dm->getRepository(Principalknowledge::class)->find($id);
     
       if("object" == getType($knowledge)){
       
        $knowledgeData[] = ['id'       => $knowledge->getId(), 
                            'languaje' => $lang,
                            'title'    => $knowledge->getTitle(), 
                            'body'     => $knowledge->getBody()];
        
       }
       return  new ArrayCollection($knowledgeData);

    }
}