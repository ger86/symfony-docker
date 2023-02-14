<?php

namespace App\Controller;

use App\Document\Author;
use App\Document\Books;
use App\Document\DobleClass;
use App\Document\Sampledata;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\UnitOfWork;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QueriesController extends AbstractController
{
    /**
     * @Route("/queries", name="app_queries")
     */
    public function index(DocumentManager $dm): Response
    {
  
        //  $repository = $dm->getRepository(Books::class)->findAll();

         $repository = $dm->getRepository(Books::class);
         $products = $repository->findAll();
        
    //     ->field('nombre')->range(20, 30);
    // $q = $qb->getQuery();
    // $users = $q->execute();
   
    // return new JsonResponse(array('Status' => $products ));



//     $author = $dm->find(Books::class, '634298de10dadef5240d5ab3');
// $collectionBooks = $dm->createQueryBuilder(Author::class)
//      ->field('author')->references($author)
//     // ->field('datePublicacion')->range(1000, 2036)
//     ->getQuery()->execute();


  

 // $user = $dm->createQueryBuilder(Author::class)
//     ->field('books')->references($repository)
//     ->getQuery()->execute();


// $post = $dm->createQueryBuilder(Books::class)
//   ->field('nombre')->equals('Fieras al volante')
//     ->getQuery()
//     ->getSingleResult();


    $categories = $dm->createQueryBuilder(Books::class)
    ->sort('nombre', 'asc')
    ->getQuery()
    ->execute();


    $users = $dm->getRepository(Author::class)->findBy(['id' => '6341520692cd2eb4340606bc']);

    //  $re = $users->getBooks();


    $getB = $dm->find(Author::class, '6341520692cd2eb4340606bc');
$qb = $dm->createQueryBuilder(Books::class)
->field('author')->references($getB)
->field('nombre')->equals('Speedy Gonzales')
->getQuery();

        return $this->render('queries/index.html.twig', [
           'qb' =>  $products,
            'h' => $categories,
            'u' => $users[0],
            'bk'=> $qb
        ]);
    }
}
