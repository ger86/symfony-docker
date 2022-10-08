<?php

namespace App\Controller;

use App\Document\Product;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use MongoDB\Client as Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewproductController extends AbstractController
{
    /**
     * @Route("/newproduct", name="app_newproduct")
     */
    public function index(DocumentManager $dm): Response
    {

//   $client = new Client("mongodb://root:mongopwd@mongodbN:27017"); 
//    $collection = $client->finaly->newProductx;
//    $result_null = $collection->find(["name"=> "Do mosetijgn po"]);
//    var_dump($result_null);
   

// //   $result_null = $collection->insertOne(['name' =>'pochito']);
//   $result = $collection->find();
//   var_dump($result);  
//         $user = new Product();
//         $user = $dm->find(Product::class, 2)->find();
// --------------------------------//
            // $product = new Product();
            // $product->setName('Do mosetijgn po'); 

            // $dm->persist($product);
            // $dm->flush();
// --------------------------------//
// $product = $dm->getRepository(Product::class)->findAll();
//  $op = $dm->getClient();
//  echo $op;
// echo $product;
 
 $user = $dm->getRepository(Product::class);

 $usersInGroup = $user->findAll();
//   var_dump($usersInGroup);
 
  return $this->render('newproduct/index.html.twig', [
    'data' => $usersInGroup,
]);
        
    }
}
