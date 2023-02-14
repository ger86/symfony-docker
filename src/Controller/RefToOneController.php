<?php

namespace App\Controller;

use App\Document\RefToOne;
use App\Document\Sampledata;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RefToOneController extends AbstractController
{
    /**
     * @Route("/reftoone", name="app_ref_to_one")
     */
    public function index(DocumentManager $dm): Response
    {

   $sample = $dm->find(Sampledata::class, "6334a57274db924eee0a4db1");

   $sapledata = new RefToOne();
   
   $sapledata->setInsertdata($sample);
    $sapledata->setUndato("Esto es un dato de prueba...");
   $dm->persist($sapledata);

      $dm->flush();


        return $this->render('ref_to_one/index.html.twig', [
            'controller_name' => 'RefToOneController',
        ]);
    }
}
/**
 * El resultado de este query es la insertar en la variable insertData el contenido 
 * de sampledata en donde insertData solo sirve para almacenar los datos de sampledata
 * ya qie refToOne tiene su propio espacio para almacenar sus datos y sample data 
 * se incorpora a los datos 
 * 
 * $ref: nos da una pista para saber desde donde se han incrustado estos datos 
*/
// {
//     "_id": {
//       "$oid": "63337217e8878ed65803e193"
//     },
//     "insertData": {
//       "$ref": "Sampledata",
//       "$id": {
//         "$oid": "63336ffee8878ed65803e191"
//       }
//     }
//   }