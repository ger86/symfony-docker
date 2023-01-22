<?php

namespace App\CustomHelper\Homehelper;

use App\Document\Homedata\Principalknowledge;
use App\Document\Languajes;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SaveKnowledge extends AbstractController
{

  private $dm; 

  public function __construct(DocumentManager $dm)
  { 
      $this->dm = $dm;   
  }


  public function saveKnowledgeInDatabase(array $knowledge): string|bool
  {
    try {
      $languaje = $this->dm->getRepository(Languajes::class)->findOneBy(
        ['languaje' => $knowledge['languaje']]
      );
      $newKnowledge = new Principalknowledge();
      $newKnowledge->setTitle($knowledge['title']);
      $newKnowledge->setBody($knowledge['htmlarea']);
      $newKnowledge->setLanguaje($languaje);
      $this->dm->persist($newKnowledge);
      $this->dm->flush();

      $result = $newKnowledge->getId() != null ? true : false;
      return $result;
    } catch (\Throwable $th) {
      return $th;
    }
  }

  public function edditKnowledgeInDatabase(array $knowledge): string|bool
  {
    try {
      $languaje = $this->dm->getRepository(Languajes::class)->findOneBy(
        ['languaje' => $knowledge['languaje']]
      );

      $resultUpdatedKnowledge = $this->dm->createQueryBuilder(Principalknowledge::class)
        ->updateOne()
        ->field('title')->set($knowledge['title'])
        ->field('body')->set($knowledge['htmlarea'])
        ->field('languaje')->set($languaje)
        ->field('_id')->equals($knowledge['id'])
        ->getQuery()
        ->execute();

      return $resultUpdatedKnowledge->getModifiedCount();
    } catch (\Throwable $th) {
      return $th;
    }
  }

  public function deletteKnowledgeInDatabase($id): string|bool
  {
    try {
       
      $removeThis = $this->dm->getRepository(Principalknowledge::class);
      $findKnowledge = $removeThis->findOneBy(['id'=> $id ]);
        if("object" == getType($findKnowledge)){
          $this->dm->remove( $findKnowledge );
          $this->dm->flush(); 
          return true;
        } else {
          return 'no object found';
        }
     

    } catch (\Throwable $th) {
      return $th;
    }
  }
}
