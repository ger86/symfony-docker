<?php

namespace App\Controller\Home;

use App\CustomHelper\Design\DesignHelper;
use App\CustomHelper\GetKnowledges\GetSingleKnowlegeByid;
use App\CustomHelper\Homehelper\SaveKnowledge;
use App\CustomHelper\Jobs\JobsHelper;
use App\CustomHelper\Web\WebHelper;
use App\CustomHelper\Works\WorksHelper;
use App\Form\Design\DesignType;
use App\Form\Jobs\JobsType;
use App\Form\PrincipalKnowledge\PrincipalKnowledgeType;
use App\Form\Web\WebType;
use App\Form\Works\WorksType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeSectionsController extends AbstractController
{
    /**
     * @Route("/home/sections", name="app_home_sections")
     */
    public function index(
        Request $request,
        GetSingleKnowlegeByid $knowlegeById,
        SaveKnowledge $knowledge,
        DesignHelper $designhelper,
        WebHelper $webhelper,
        JobsHelper $jopshelper,
        WorksHelper $worksHelper
    ): Response {
        $getLoguinStatus = intval(
            $request->cookies->get($_ENV['SECRETNAME_KOOKIE'])
        );
        if (!$getLoguinStatus) {
            return $this->redirectToRoute('app_home');
        }

        $status = null;
        $isActive = 'principal_knowledges';
        if ($request->query->get('active') != null) {
            switch ($request->query->get('active')) {
                case 'principal_knowledges':
                    $isActive = 'principal_knowledges';
                    if (
                        'principal_knowledges' ==
                        $request->query->get('savetype')
                    ) {
                        $saveKnowledgeResult = $knowledge->saveKnowledgeInDatabase(
                            $request->request->get('principal_knowledge')
                        );

                        if (
                            true == $saveKnowledgeResult &&
                            'boolean' == getType($saveKnowledgeResult)
                        ) {
                            $status = '✨ knowledge Saved Suscessfully';
                        } else {
                            $status = '🤬 ' . $saveKnowledgeResult;
                        }
                    }

                    if (
                        'eddit_knowledges' == $request->query->get('savetype')
                    ) {
                        $edditKnowledgeResult = $knowledge->edditKnowledgeInDatabase(
                            $request->request->all()['principal_knowledge']
                        );

                        if (
                            '1' == $edditKnowledgeResult &&
                            'string' == getType($edditKnowledgeResult)
                        ) {
                            $status = '✨ knowledge Eddited Suscessfully';
                        } else {
                            $status = '🤬 ' . $edditKnowledgeResult;
                        }
                    }

                    break;

                case 'deletteKnowledges':
                    $id = $request->query->get('id');

                    $deletedKnowledge = $knowledge->deletteKnowledgeInDatabase(
                        $id
                    );
                    if ($deletedKnowledge == true) {
                        return $this->redirectToRoute('app_home_section_list');
                    } else {
                        $status = '🤬 ' . $deletedKnowledge;
                    }

                    break;

                case 'graphicDesign':
                    $isActive = 'graphicDesign';
                    if ('designElement' == $request->query->get('savetype')) {
                        $rsultWeb = $designhelper->saveDesign(
                            $request->request->all()['design']
                        );
                        $rsultWeb
                            ? ($status = '✨ Design saved Suscessfully')
                            : $rsultWeb;
                    }
                    break;
                case 'web_developer':
                    $isActive = 'web_developer';
                    if ('webElement' == $request->query->get('savetype')) {
                        $rsultWeb = $webhelper->saveWeb(
                            $request->request->all()['web']
                        );
                        $rsultWeb
                            ? ($status = '✨ Web saved Suscessfully')
                            : $rsultWeb;
                    }
                    break;

                case 'jobs_timeLine':
                    $isActive = 'jobs_timeLine';
                    if ('timeline' == $request->query->get('savetype')) {
                        $rsultJop = $jopshelper->saveJop(
                            $request->request->all()['jobs']
                        );
                        $rsultJop
                            ? ($status = '✨ Job saved Suscessfully')
                            : $rsultJop;
                    }
                    break;
                   
                    case 'some_works':
                        $isActive = 'some_works'; 
                        if ('someWorks' == $request->query->get('savetype')) {
                            $rsultJop = $worksHelper->saveWorks(
                                $request->request->all()['works']
                            );
                            $rsultJop
                                ? ($status = '✨ Works saved Suscessfully')
                                : $rsultJop;
                        }
                        break;
            }
        }

        $PrincipalKnowledgeType = $this->createForm(
            PrincipalKnowledgeType::class,
            null,
            [
                'attr' =>
                    $request->query->get('active') == 'editDataKnowledge'
                        ? $knowlegeById->returnKnowledge(
                            $request->query->get('id'),
                            $request->query->get('lang')
                        )[0]
                        : [],
            ]
        );

        $DesignTypeForm = $this->createForm(DesignType::class);

        $WebTypeForm = $this->createForm(WebType::class);

        $JobsTypeForm = $this->createForm(JobsType::class);

        $WorkTypeForm = $this->createForm(WorksType::class);

        $edditing =
            $request->query->get('active') == 'editDataKnowledge'
                ? true
                : false;

        return $this->render('home_sections/index.html.twig', [
            'active' => $isActive,
            'PrincipalKnowledgeType' => $PrincipalKnowledgeType->createView(),
            'DesignFormType' => $DesignTypeForm->createView(),
            'WebTypeForm' => $WebTypeForm->createView(),
            'JobsTimelineForm' => $JobsTypeForm->createView(),
            'worksForm' => $WorkTypeForm->createView(),
            'status' => $status,
            'edditing' => $edditing,
        ]);
    }
}
