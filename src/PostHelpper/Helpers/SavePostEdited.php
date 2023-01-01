<?php

namespace App\PostHelpper\Helpers;

 
 
use App\Document\BlogDocument\Blog;
use App\Document\Category;
use App\Document\Languajes;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class SavePostEdited extends AbstractController
{    
    private $dm; 

    public function __construct( DocumentManager $dm )
    {
        $this->dm = $dm;  
    
    }

    
    public function getDataToSavePostEditedInDatabase(array $postData): int
    {
        // * $postIdObject: objectWiththePost::class Collectiom
        $dm = $this->dm;

    //    dd( $postData );
       
        $category = $dm->getRepository(Category::class)->findOneBy(
            ['category' => $postData["categories"]]
          );
  
  
          $languaje = $dm->getRepository(Languajes::class)->findOneBy(
            ['languaje' => $postData["languaje"]]
          );
         
  
          $dateTime = $postData["publishedAt"]["day"] . "-" .
            $postData["publishedAt"]["month"] . "-" .
            $postData["publishedAt"]["year"];
  
          $getKeywords = explode(' ', $postData["keywords"]);
      
  
        
         
            $resultUpdatedPost = $dm->createQueryBuilder(Blog::class)
            ->updateOne()
            ->field('title')->set($postData["Titulo_del_post"])
            ->field('urlFriendly')->set($postData["FriendlyUrl"])
            ->field('body')->set($postData["htmlarea"])
            ->field('keyword')->set($getKeywords)
            ->field('imageUrl')->set($postData["featured_Image"])
            ->field('status')->set($postData["published_status"])
            ->field('datePublished')->set(new DateTime($dateTime)) 
            ->field('languaje')->set($languaje)
            ->field('category')->set($category)
            ->field('_id')->equals($postData["PostId"]) 
            ->getQuery()
            ->execute();

          // dd($resultUpdatedPost->getModifiedCount());
            
            return $resultUpdatedPost->getModifiedCount(); // if is true return 1 or 0 is null
        } 
    }
 