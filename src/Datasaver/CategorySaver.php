<?php

namespace App\Datasaver;

use App\Document\Books;
use App\Document\Category;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class CategorySaver extends AbstractController
{
    private $dm;

    public function __construct(DocumentManager $dm )
    {
        $this->dm = $dm;
    }

    public function saveCategory($category):  ArrayCollection
    { 
       try {
        $setcategory = new Category(); 
        $setcategory->setCategory($category);
        $this->dm->persist($setcategory);
        $this->dm->flush();
           
        return self::getAllCategory(); 
       } catch (\Exception $e) {
         return array('error' => $e->getMessage());
       }
        
    }

    public function getAllCategory(){
        $repository = $this->dm->getRepository(Category::class);
        $products = $repository->findAll();
        return new ArrayCollection(array($products));  
    }

}