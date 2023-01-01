<?php

namespace App\Controller\Blog;

use App\Document\BlogDocument\Blog;
use App\Document\Category;
use App\Document\Languajes;
use App\Form\Articleform;
use App\Feching\Fetchdata;
use DateTime;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NewblogController extends AbstractController
{
  public $status; 

  public function __construct()
    {
        $this->status = false;
    } 

  /**
   * @Route("/blog/newblog", name="app_newblog")
   */
  public function index(Request $request, Fetchdata $fetchdata, DocumentManager $dm): Response
  {

    

    $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
    if (!$getLoguinStatus) {
      return $this->redirectToRoute("app_home");
    }


    try {

       // ! CONVERTIR TODO ESTO EN UN SERVICIO !!!!!!!!! 

      if ("array" == getType($request->request->get("articleform"))) {

      
        $category = $dm->getRepository(Category::class)->findOneBy(
          ['category' => $request->request->get("articleform")["categories"]]
        );


        $languaje = $dm->getRepository(Languajes::class)->findOneBy(
          ['languaje' => $request->request->get("articleform")["languaje"]]
        );
       

        $dateTime = $request->request->get("articleform")["publishedAt"]["day"] . "-" .
          $request->request->get("articleform")["publishedAt"]["month"] . "-" .
          $request->request->get("articleform")["publishedAt"]["year"];

        $getKeywords = explode(' ', $request->request->get("articleform")["keywords"]);
    

       $newPost = new Blog();
        // ? set the title of the post 
        $newPost->setTitle($request->request->get("articleform")["Titulo_del_post"]);
        // ? set the friendly url of the post 
        $newPost->setUrlFriendly($request->request->get("articleform")["FriendlyUrl"]);
        // ? set the html body of the post 
        $newPost->setBody($request->request->get("articleform")["htmlarea"]);
        // ? set the image of the post 
        $newPost->setImageUrl($request->request->get("articleform")["featured_Image"]);
        // ? set the status of the post 
        $newPost->setStatus($request->request->get("articleform")["published_status"]);
        // ? set the keywords of the post 
        $newPost->setKeyword( $getKeywords );
        // ? set the languajes of the post 
        $newPost->setLanguaje($languaje);
        // ? set the category of the post 
        $newPost->setCategory($category);
        // ? set the date of the post 
        $newPost->setDatePublished(new DateTime($dateTime));
        $dm->persist($newPost);
        $dm->flush();
      
        $this->status = $newPost->getId() != null ? true : false ;
      }
     } catch (\Throwable $e) {
      dd($e);
    }
 
    $imageBank = $fetchdata->fetchGitHubInformation();
    $form = $this->createForm(Articleform::class);

    return $this->render('newblog/index.html.twig', [
      'Articleform'  => $form->createView(),
      'mediaElement' => $imageBank,
      'status'       => $this->status 
    ]);
  }
}
