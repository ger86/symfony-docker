<?php

namespace App\PostHelpper\Category;


use App\Document\Category;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetCategory extends AbstractController
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }


    public function getAllCategory(): ArrayCollection
    {


        $outputCategorys = [];
        $getCategoryRepository = $this->dm->getRepository(Category::class);
        $categpryRepository = $getCategoryRepository->findAll();
        //   dd( get_mangled_object_vars(  $categpryRepository[0] ) );
        for ($i = 0; $i < count($categpryRepository); $i++) {

            $outputCategorys[] = get_mangled_object_vars(
                $categpryRepository[$i]
            )["\x00App\Document\Category\x00category"];
        }
        return new ArrayCollection($outputCategorys);
    }
}
