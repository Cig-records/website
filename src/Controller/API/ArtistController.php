<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    /**
     * @Route("/a/p/i/artist", name="a_p_i_artist")
     */
    public function index(): Response
    {
        return $this->render('api/artist/index.html.twig', [
            'controller_name' => 'ArtistController',
        ]);
    }
}
