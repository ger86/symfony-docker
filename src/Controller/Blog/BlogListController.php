<?php

namespace App\Controller\Blog;

use App\CustomHelper\Post\DelettePost;
use App\Document\BlogDocument\Blog;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogListController extends AbstractController
{
    /**
     * @Route("/blog/list", name="app_blog_list")
     */
    public function index(DocumentManager $dm,Request $request, DelettePost $delettePost): Response
    {
        $status = false;
        $getLoguinStatus = intval($request->cookies->get($_ENV['SECRETNAME_KOOKIE']));
        if (!$getLoguinStatus) {
          return $this->redirectToRoute("app_home");
        }
        if ($request->query->get('type') != null) {
            switch ($request->query->get('type')) {
                case 'Delette' :
                   $result = $delettePost->delettePost( $request->query->get('value'));
                   if("string" == gettype( $result )){
                     $status = $result;
                   }
                   if( 1 ==  $result){
                    $status = '✨ post delette sucessfully';
                  }
                  

                break;
            }
        }
       
        $allBlog = $dm->getRepository(Blog::class)->findAll();

        return $this->render('blog_list/index.html.twig', [
            'BlogList' => $allBlog,
            'status'   => $status
        ]);
    }
}
