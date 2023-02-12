<?php

namespace App\Controller\Blog;

use App\Feching\Fetchdata;
use App\Form\Actions\EdditForm;
use App\CustomHelper\Post\SavePostEdited;
use App\CustomHelper\Post\SetDataForEddit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EdditPostController extends AbstractController
{
    public $filtredPostEdditData = null;
    public $GetBlogForEddit;
    public $postValues;
    public $status;

    public function __construct()
    {
        $this->GetBlogForEddit = [];
        $this->status = false;
    }

    /**
     * @Route("/eddit/post", name="app_eddit_post")
     */
    public function index(
        Fetchdata $fetchdata,
        Request $request,
        SetDataForEddit $SetDataForEddit,
        SavePostEdited $savePostEdited
    ): Response {
        //   dd($request->query->all(), $request->request->get("eddit_form"));

        // ? INFO:
        // * $request->query->all():                Get all queries regarding GET sended by url
        // * $request->request->get("eddit_form"):  Get all data from form through POST

        // security
        $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
        if (!$getLoguinStatus) {
            return $this->redirectToRoute("app_home");
        }


        if ($request->query->get('type')) {
            switch ($request->query->get('type')) {
                case 'Eddit':
                    $this->filtredPostEdditData =  $SetDataForEddit->getFiltredDataForFillPostOrShowPost($request->query->get('value')); 
                    break;
                case 'save':
                    try {
                        $edditResult = $savePostEdited->getDataToSavePostEditedInDatabase($request->request->get("eddit_form"));
                        $this->status = $edditResult == 1 ? true : false;
                        $this->filtredPostEdditData = $SetDataForEddit->getFiltredDataForFillPostOrShowPost($request->request->get("eddit_form")['PostId']); 
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    break;
            }
        }


        // to pass data to form then we can fill the fields
        // ? Note: 
        // * toArray(): transform a ArrayCollection to a array php
        $get_form = $this->createForm(EdditForm::class, null, [
            'attr' =>  $this->filtredPostEdditData->toArray()
        ]);
        
        $imageBank = $fetchdata->fetchGitHubInformation();

        return $this->render('eddit_post/index.html.twig', [
            'edditform' => $get_form->createView(),
            'mediaElement' => $imageBank,
            'status'       => $this->status,
            'id'           => $this->filtredPostEdditData->toArray()['id']
        ]);
    }
}
