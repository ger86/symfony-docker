<?php

namespace App\CustomHelper\Faqs;

use App\Document\Faqs\Faqs;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
 

class GetFaqById extends AbstractController
{    
    private $dm; 
    private $faqValues = [];

    public function __construct( DocumentManager $dm )
    {
        $this->dm = $dm;
    }
    public function getDataFaqFromId($id): ArrayCollection
    { 

        // dd($id);
        try {

            $getFaq = $this->dm->find(Faqs::class, $id); 
            $this->faqValues['id'] = $getFaq->getId();
            $this->faqValues['question'] = $getFaq->getQuestion();
            $this->faqValues['response'] = $getFaq->getResponse();
             
            return new ArrayCollection( $this->faqValues );
       
            
          } catch (\Throwable $error) {
           dd($error);
          }
        }   
}
 