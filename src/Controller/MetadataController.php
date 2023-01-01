<?php

namespace App\Controller;

use App\PostHelpper\Category\CategorySaver;
use App\PostHelpper\Category\GetCategory;
use App\Form\CategoryType;
use App\Form\LanguajeType;
use App\PostHelpper\Category\DeletteCategory;
use App\PostHelpper\Languaje\GetLanguaje;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetadataController extends AbstractController
{
  /**
   * @Route("/metadata", name="app_metadata")
   */
  public function index(
    Request $request,
    CategorySaver $saveCategory,
    GetCategory $GetCategory,
    GetLanguaje $languaje,
    DeletteCategory $delette
  ): Response {

    //  dd($request->request->all());


    $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
    if (!$getLoguinStatus) {
      return $this->redirectToRoute("app_home");
    }

    $form = $this->createForm(LanguajeType::class);
    $CategoryForm = $this->createForm(CategoryType::class);

    if (isset($request->request->get('languaje')['languaje'])) {
    };

    $isActive = '';
    if ($request->query->get('active') != null) {
      $isActive = $request->query->get('active');
    } else {
      $isActive = 'lang';
    }

    $categories = [];



    if (isset($request->request->get('category')['category'])) {
      $getcategory = $request->request->get('category')['category'];
      $response = $saveCategory->saveCategory($getcategory);
      $categories = $response;
      $isActive = 'cat';
    };

    if ($request->query->get('active') != null) {
      $isActive = $request->query->get('active');
      $confirmDeletteAction = explode('_', $isActive);
      if ('delette' == $confirmDeletteAction[0]) {
        $delette->removeCategory($confirmDeletteAction[1]);
        $isActive = 'cat';
      }
    }

    return $this->render('metadata/index.html.twig', [
      'LanguajeForm' =>  $form->createView(),
      'CategoryForm' =>  $CategoryForm->createView(),
      'active'       =>  $isActive,
      'categories'   =>  $categories != '' ? $GetCategory->getAllCategory() : null,
      'languajes'     =>  $languaje->getAllLanguaje()
    ]);
  }
}
