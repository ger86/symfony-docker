<?php

namespace App\Controller\Blog;

use App\Document\BlogDocument\Blog;
use App\Document\Category;
use App\Document\Languajes;
use App\Form\Articleform;
use App\Feching\Fetchdata;
use App\CustomHelper\Helpers\SavePost;
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
  public function index(Request $request, Fetchdata $fetchdata, DocumentManager $dm, SavePost $savePost): Response
  {
    $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
    if (!$getLoguinStatus) {
      return $this->redirectToRoute("app_home");
    }
    try {
      if ("array" == getType($request->request->get("articleform"))) {
        $this->status =  $savePost->getDataToSavePostInDatabase($request->request->get("articleform"));
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
