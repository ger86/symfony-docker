<?php

namespace App\Controller\Blog;


use App\Form\Articleform;
use App\Feching\Fetchdata;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NewblogController extends AbstractController
{
  /**
   * @Route("/blog/newblog", name="app_newblog")
   */
  public function index(Request $request, Fetchdata $fetchdata): Response
  {
    $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
    if (!$getLoguinStatus) {
      return $this->redirectToRoute("app_home");
    }
    
    if( "array" == getType($request->request->get("articleform" )) ){ 
       dd($request->request->get("articleform" ));
    };

    // {#8 ▼
  #parameters: array:1 [▼
//     "articleform" => array:10 [▼
//     "Titulo_del_post" => "911 Eleazar Manor"
//     "FriendlyUrl" => "Sint eveniet sint."
//     "htmlarea" => ""
//     "keywords" => "sunt aut unde"
//     "categories" => "NextJS"
//     "featured_Image" => "Esse mollitia quia voluptate nostrum est."
//     "published_status" => "1"
//     "languaje" => "2"
//     "publishedAt" => array:3 [▶]
//     "_token" => "H5uNyO-O5esraFrwyDMB6prDGfBMGvfv8INDdKCFF_A"
//   ]
// ]
// }

    $imageBank = $fetchdata->fetchGitHubInformation();
    $form = $this->createForm(Articleform::class);

    return $this->render('newblog/index.html.twig', [
      'Articleform'  => $form->createView(),
      'mediaElement' => $imageBank
    ]);
  }
}
