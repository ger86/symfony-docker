<?php

namespace App\Controller;

use App\Document\Elpadre;
use App\Document\Loshijos;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PadrehijosController extends AbstractController
{
    /**
     * @Route("/padrehijos", name="app_padrehijos")
     */

    public function index(DocumentManager $dm ): Response
    {

        // $padre = new Elpadre();
        // $padre->setName('Rodolfo');
        // $padre->setEdad(33);

        // $hijo = new Loshijos();
        // $hijo->setName('Rodolfito junior');
        // $hijo->setPadre($padre);

        // $hijo1 = new Loshijos();
        // $hijo1->setName('Rodolfito manuel');
        // $hijo1->setPadre($padre);

        // $hijo2 = new Loshijos();
        // $hijo2->setName('Rodolfito baby');
        // $hijo2->setPadre($padre);

        // $dm->persist($padre);
        // $dm->persist($hijo);
        // $dm->persist($hijo1);
        // $dm->persist($hijo2);
        // $dm->flush();

        $padreId = "635d10fe29136861fe0e0761";

        $padre = $dm->find(Elpadre::class, $padreId);
        $hijo = new Loshijos();
        $hijo->setName('Rodolfito elJabao');
        $hijo->setPadre($padre);

        $dm->persist($hijo);
        $dm->flush();

        $allHijos = $padre->getHijos();
         
       //  return new JsonResponse($padreId);
        return $this->render('padrehijos/index.html.twig', [
            'hijos' => $allHijos,
        ]);
    }
}
