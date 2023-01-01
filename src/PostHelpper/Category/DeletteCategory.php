<?php

namespace App\PostHelpper\Category;

 
use App\Document\Category;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeletteCategory extends AbstractController
{
    private $dm;
    private $GetCategory;

    public function __construct(DocumentManager $dm, GetCategory $GetCategory)
    {
        $this->dm = $dm;
        $this->GetCategory = $GetCategory;
    }

    public function removeCategory($categoryToRemove): array
    {
        try {
            // $getCategoryCollection = $this->GetCategory->getAllCategory();
           
           $removeThis = $this->dm->getRepository(Category::class);
           $remov = $removeThis->findOneBy(['category'=> $categoryToRemove ]);
            
           $this->dm->remove( $remov);
           $this->dm->flush();
             
            return [];
       
        //    return new ArrayCollection( [$getCategoryCollection] );
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    } 
}