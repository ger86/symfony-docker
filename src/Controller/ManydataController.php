<?php

namespace App\Controller;

use App\Document\Author;
use App\Document\Books; 

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManydataController extends AbstractController
{
    /**
     * @Route("/manydata", name="app_manydata")
     */
    public function index(DocumentManager $dm): Response 
    {
        // $listCate = array("caramelo", "bombom", "panceta","colomba");
        // $insertcategories = new Categories();
        
        //  $insertcategories->setCategories($listCate);

        // $dm->persist($insertcategories);
        // $dm->flush();
 
            // $categ = $dm->find(Categories::class, "63374917a634b7cf34076d93");

            // $many = new Manyexample();

            // $many->setPost('Este es el tema de un nuevo post');
            // $many->setMuxadata(); 

            //  $dm->persist($many);

            // $dm->flush();

        //  $aut = new Author();
        //  $aut->setNombre("Numancio Peguero");
        
        // Si quiero inyectar el mismo user sin crear nuevos
        //  $autorId = $dm->find(Author::class, '6341520692cd2eb4340606bc');
        
        // $bookOne = new Books();
        // $bookOne->setNombre('Speedy Gonzales');
        // $bookOne->setCategories(array('Caberna', 'Bomerang', 'Comic'));
        // $bookOne->setDatePublicacion(2015);
        // $bookOne->setAuthor($autorId);

        // $bookOne2 = new Books();
        // $bookOne2->setNombre('Fieras al volante');
        // $bookOne2->setCategories(array('estrateg', 'hooke', 'madrid'));
        // $bookOne2->setDatePublicacion(2000);
        // $bookOne2->setAuthor($aut);
        
        // $dm->persist($aut);
        // $dm->persist($bookOne);
        // $dm->persist($bookOne2);

        // $dm->flush();

        $getB = $dm->find(Author::class, '6341520692cd2eb4340606bc');
        $res = $getB->getBooks();
         
        $getABook = $dm->find(Books::class, '634152d192cd2eb4340606c1');
        $getAut = $getABook->getAuthor();

        return $this->render('manydata/index.html.twig', [
            'book' => $res,
            'auth' => $getAut,
            'oneb' => $getABook
        ]);
    }
}
