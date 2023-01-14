<?php

namespace App\CustomHelper\Status;


use App\Document\Category;
use App\Document\Status;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetStatus extends AbstractController
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }


    public function getAllStatus(): ArrayCollection
    { 
        $outputStatus = [];
        $getStatusRepository = $this->dm->getRepository(Status::class);
        $statusRepository = $getStatusRepository->findAll();
         
        for ($i = 0; $i < count($statusRepository); $i++) {
         
            $outputStatus[] = get_mangled_object_vars(
                $statusRepository[$i]
            )["\x00App\Document\Status\x00status"];
        }
     
        return new ArrayCollection($outputStatus);
    }

    public function setNewStatus($status){
          $setNewStatus = new Status();
          $setNewStatus->setStatus($status);
          $this->dm->persist($setNewStatus);
          $this->dm->flush();

    }
}
