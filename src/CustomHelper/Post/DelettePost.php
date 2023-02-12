<?php

namespace App\CustomHelper\Post;

 
 
use App\Document\BlogDocument\Blog;
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class DelettePost extends AbstractController
{    
    private $dm; 

    public function __construct( DocumentManager $dm )
    {
        $this->dm = $dm;  
    
    }

    
    public function delettePost(string $id): int|string
    {
        // * $postIdObject: objectWiththePost::class Collectiom
        $dm = $this->dm;

           
            try { 
                $blogRepository = $this->dm->createQueryBuilder(Blog::class)
                    ->findAndRemove()
                    ->field('id')->equals($id)
                    ->getQuery()
                    ->execute();
     
                  return !$blogRepository->getId() ? false : true;
               
             } catch (\Throwable $th) {
              return $th->getMessage();
             }
        } 
    }
 