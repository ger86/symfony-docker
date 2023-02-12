<?php

namespace App\Controller\Home\Jobs;

use App\CustomHelper\Jobs\JobsHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeJobsListController extends AbstractController
{
    /**
     * @Route("/jobs/list", name="app_home_jobs_list")
     */
    public function index(
        Request $request, 
        JobsHelper $jobsHelper
    ): Response
    {
        $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
         if (!$getLoguinStatus) {
             return $this->redirectToRoute("app_home");
         }

        if ($request->query->get('active') != null) {
            switch ($request->query->get('active')) {
                case 'deletteJobs' :
                  
                break;
            }
        }


        return $this->render('jobs_list/index.html.twig', [
            'jobsList' => $jobsHelper->getJobs()
        ]);
    }
}
