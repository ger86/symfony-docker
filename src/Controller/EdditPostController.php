<?php

namespace App\Controller;

use App\Document\BlogDocument\Blog;
use App\Form\Actions\EdditForm;
use App\PostHelpper\Helpers\SetDataForEddit;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EdditPostController extends AbstractController
{
    public $GetBlogForEddit;
    public $postValues;

    public function __construct()
    {
        $this->GetBlogForEddit = [];
        // $this->postValues = [];
    }

    /**
     * @Route("/eddit/post", name="app_eddit_post")
     */
    public function index(DocumentManager $dm, Request $request, SetDataForEddit $SetDataForEddit): Response
    {
        // security
        $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
        if (!$getLoguinStatus) {
            return $this->redirectToRoute("app_home");
        }
        if (
            $request->query->get('type') != null &&
            'Eddit' == $request->query->get('type')
        ) {
            $filtredPostEdditData =  $SetDataForEddit->getFiltredDataForFillPostOrShowPost($request->query->get('value'));
        }
        // to pass data at the form then we can fill the fields 
        $get_form = $this->createForm(EdditForm::class, null, [
            'attr' => $filtredPostEdditData->toArray()
        ]);


        return $this->render('eddit_post/index.html.twig', [
            'edditform' => $get_form->createView()
        ]);
    }
}
