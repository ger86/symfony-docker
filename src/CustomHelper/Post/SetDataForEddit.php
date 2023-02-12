<?php

namespace App\CustomHelper\Post;

 
 
use App\Document\BlogDocument\Blog;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class SetDataForEddit extends AbstractController
{    
    private $dm;
    public $postValues; 
    public $GetBlogForEddit; 

    public function __construct(
        DocumentManager $dm
        )
    {
        $this->dm = $dm; 
        $this->postValues = [];
        $this->GetBlogForEddit = [];
    
    }

    
    public function getFiltredDataForFillPostOrShowPost($postId): ArrayCollection
    {
        // * $postIdObject: objectWiththePost::class Collectiom
        $dm = $this->dm;
        
        $this->GetBlogForEddit = $dm->find(Blog::class, $postId);
            
             $postIdObject =  $this->GetBlogForEddit;
            $getDataPublished = $postIdObject->getDatePublished();
            $formatedDataPublished = $getDataPublished->format('Y-m-d');


         
          $this->postValues['id'] = $postIdObject->getId();
          $this->postValues['title'] = $postIdObject->getTitle();
          $this->postValues['friendlyURL'] = $postIdObject->getUrlFriendly();
          $this->postValues['body'] = $postIdObject->getBody();
          $this->postValues['imageURL'] = $postIdObject->getImageUrl();
          $this->postValues['Status'] = $postIdObject->getStatus()->getStatus();
          $this->postValues['keyworl'] = $postIdObject->getKeyword();
          $this->postValues['date'] = $formatedDataPublished;
          $this->postValues['category'] = $postIdObject->getCategory()->getCategory();
          $this->postValues['languaje'] = $postIdObject->getLanguaje()->getLanguaje();
         
            return new ArrayCollection( $this->postValues );
        } 
    }
 