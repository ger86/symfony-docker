<?php

namespace App\CustomHelper\work;

use App\Document\Works\WorksDocument;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WorkHelper extends AbstractController
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function saveWork($work): string|bool
    {
        try {

            $newWork = new WorksDocument();
            $newWork->setTitle($work['title']);
            $newWork->setTools($work['tools']);
            $newWork->setImage($work['image']);
            $newWork->setLink($work['link']);
            $newWork->setBody($work['body']);

            $this->dm->persist($newWork);
            $this->dm->flush();
            return !$newWork->getId() ? false : true;

            return true;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}
