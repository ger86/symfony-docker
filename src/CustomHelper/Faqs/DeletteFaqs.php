<?php

namespace App\CustomHelper\Faqs;

use App\Document\Faqs\Faqs; 
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class DeletteFaqs extends AbstractController
{    
    private $dm; 

    public function __construct( DocumentManager $dm )
    {
        $this->dm = $dm;  
    
    }

    
    public function deletteFaq(string $id): int|string
    {
      
            try { 
                $pageRepository = $this->dm->createQueryBuilder(Faqs::class)
                    ->findAndRemove()
                    ->field('id')->equals($id)
                    ->getQuery()
                    ->execute();
     
                  return !$pageRepository->getId() ?  'Faq no eliminado' : 'Faq Eliminado';
               
             } catch (\Throwable $error) {
              return $error->getMessage();
             }
        } 
    }