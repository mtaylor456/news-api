<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/image-news", name="imagenews")
     */
    public function indexAction(Request $request)
    {   
         $selected = $request->request->get('source', 'bbc-news');
        
         $news = $this->container->get('api.newsapi.news');
        
         $sources = $news->sources('en'); 
         
         $headlines = $news->headlines($selected); 
            
         return $this->render('default/index.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                    'sources' => $sources,
                    'data' => $headlines,
                    'selected' => $selected
        ]);
    }
}
