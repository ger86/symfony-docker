<?php

namespace App\PostHelpper\Category;

 
use App\Document\Category;
use App\Document\Languajes;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorySaver extends AbstractController
{
    private $dm;
    private $GetCategory;

    public function __construct(DocumentManager $dm, GetCategory $GetCategory)
    {
        $this->dm = $dm;
        $this->GetCategory = $GetCategory;
    }

    public function saveCategory($category): ArrayCollection
    {
        try {
            $getCategoryCollection = $this->GetCategory->getAllCategory();
            
             
            $setcategory = new Category();
            $setcategory->setCategory($category); 
            $this->dm->persist($setcategory);
            $this->dm->flush();
             
            return $getCategoryCollection;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    } 
}