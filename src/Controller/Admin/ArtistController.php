<?php

namespace App\Controller\Admin;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\ArtistPasswordEncoderInterface;

/**
 * @Route("/admin/artist", name="admin_artist_")
 */
class ArtistController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }


    /**
     * @Route("/", name="index")
     */
    public function index(ArtistRepository $artistRepository): Response
    {
        return $this->render('admin/artist/index.html.twig', [
            'controller_name' => 'ArtistController',
            'artists' => $artistRepository->findAll()
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $artist = new Artist;
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('admin/artist/create.html.twig', [
                'artist' => $artist,
                'form' => $form->createView(),
            ]);
        }

        $this->em->persist($artist);
        $this->em->flush();

        return $this->redirectToRoute('admin_artist_index');
    }


    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @param ArtistRepository $artistRepository
     * @param Artist $artist
     * @return Response
     */
    public function show(ArtistRepository $artistRepository, Artist $artist): Response
    {
        // $artist = $artistRepository->find($id);
        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Artist $artist
     * @return Response
     */
    public function edit(Request $request, Artist $artist): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('admin/artist/edit.html.twig', [
                'artist' => $artist,
                'form' => $form->createView(),
            ]);
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_artist_index');
    }


    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Artist $artist
     * @return Response
     */
    public function delete(Request $request, Artist $artist): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artist->getId(), $request->request->get('_token'))) {
            $this->em->remove($artist);
            $this->em->flush();
        }

        return $this->redirectToRoute('admin_artist_index');
    }
}
