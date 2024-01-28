<?php

namespace App\CustomHelper\Page;

use App\Document\PageDocument\Page;
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class DelettePage extends AbstractController
{    
    private $dm; 

    public function __construct( DocumentManager $dm )
    {
        $this->dm = $dm;  
    
    }

    
    public function delettePage(string $id): int|string
    {
      
            try { 
                $pageRepository = $this->dm->createQueryBuilder(Page::class)
                    ->findAndRemove()
                    ->field('id')->equals($id)
                    ->getQuery()
                    ->execute();
     
                  return !$pageRepository->getId() ?  'Pagina no eliminada' : 'Pagina eliminada';
               
             } catch (\Throwable $error) {
              return $error->getMessage();
             }
        } 
    }
 