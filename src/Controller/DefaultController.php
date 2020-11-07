<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\AlbumRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("", name="default", methods={"GET"})
     */
    public function index(Request $request, AlbumRepository $albumRepository)
    {

        $albums = $albumRepository->findLatest();

        return $this->render('index.html.twig', [
            'albums' => $albums,
        ]);
    }


}
