<?php

namespace App\PostMetadata\Languaje;

 
use App\Document\Languajes;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class GetLanguaje extends AbstractController
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    
    public function getAllLanguaje(): ArrayCollection
    {
        $outputLanguajes = [];
        $getLanguajeRepository = $this->dm->getRepository(Languajes::class);
         $languajeRepository = $getLanguajeRepository->findAll();
             
        for ($i = 0; $i < count($languajeRepository); $i++) {
            $outputLanguajes[] = get_mangled_object_vars(
                $languajeRepository[$i]
            )["\x00App\Document\Languajes\x00languaje"];
        }
        
      return new ArrayCollection($outputLanguajes);
    }
}