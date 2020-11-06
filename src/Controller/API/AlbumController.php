<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends AbstractController
{
    /**
     * @Route("/a/p/i/album", name="a_p_i_album")
     */
    public function index(): Response
    {
        return $this->render('api/album/index.html.twig', [
            'controller_name' => 'AlbumController',
        ]);
    }
}
