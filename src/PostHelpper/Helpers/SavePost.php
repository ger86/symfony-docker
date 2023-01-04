<?php

namespace App\PostHelpper\Helpers;

 
 
use App\Document\BlogDocument\Blog;
use App\Document\Category;
use App\Document\Languajes;
use App\Document\Status;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class SavePost extends AbstractController
{    
    private $dm; 

    public function __construct( DocumentManager $dm )
    {
        $this->dm = $dm;  
    
    }

    
    public function getDataToSavePostInDatabase($postData): bool
    {
        // * $postIdObject: objectWiththePost::class Collectiom
        $dm = $this->dm;
       
        $category = $dm->getRepository(Category::class)->findOneBy(
            ['category' => $postData["categories"]]
          );
  
  
          $languaje = $dm->getRepository(Languajes::class)->findOneBy(
            ['languaje' => $postData["languaje"]]
          );


          $status = $dm->getRepository(Status::class)->findOneBy(
            ['status' => $postData["published_status"]]
          );
         
  
          $dateTime = $postData["publishedAt"]["day"] . "-" .
            $postData["publishedAt"]["month"] . "-" .
            $postData["publishedAt"]["year"];
  
          $getKeywords = explode(' ', $postData["keywords"]);
      
  
         $newPost = new Blog();
          // ? set the title of the post 
          $newPost->setTitle($postData["Titulo_del_post"]);
          // ? set the friendly url of the post 
          $newPost->setUrlFriendly($postData["FriendlyUrl"]);
          // ? set the html body of the post 
          $newPost->setBody($postData["htmlarea"]);
          // ? set the image of the post 
          $newPost->setImageUrl($postData["featured_Image"]);
          // ? set the status of the post 
          $newPost->setStatus($status);
          // ? set the keywords of the post 
          $newPost->setKeyword( $getKeywords );
          // ? set the languajes of the post 
          $newPost->setLanguaje($languaje);
          // ? set the category of the post 
          $newPost->setCategory($category);
          // ? set the date of the post 
          $newPost->setDatePublished(new DateTime($dateTime));
          $dm->persist($newPost);
          $dm->flush();
        
          $result = $newPost->getId() != null ? true : false ;
             return $result;
        } 
    }
 