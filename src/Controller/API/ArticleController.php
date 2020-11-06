<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/a/p/i/article", name="a_p_i_article")
     */
    public function index(): Response
    {
        return $this->render('api/article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
}
