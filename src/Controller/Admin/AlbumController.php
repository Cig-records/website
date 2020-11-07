<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/album", name="admin_album_")
 */
class AlbumController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }


    /**
     * @Route("/", name="index")
     */
    public function index(AlbumRepository $albumRepository): Response
    {
        return $this->render('admin/album/index.html.twig', [
            'controller_name' => 'AlbumController',
            'albums' => $albumRepository->findAll()
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $album = new Album;
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('admin/album/create.html.twig', [
                'album' => $album,
                'form' => $form->createView(),
            ]);
        }

        $this->em->persist($album);
        $this->em->flush();

        return $this->redirectToRoute('admin_album_index');
    }


    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @param Album $album
     * @return Response
     */
    public function show(Album $album): Response
    {
        // $album = $albumRepository->find($id);
        return $this->render('album/show.html.twig', [
            'album' => $album,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Album $album
     * @return Response
     */
    public function edit(Request $request, Album $album): Response
    {
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('admin/album/edit.html.twig', [
                'album' => $album,
                'form' => $form->createView(),
            ]);
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_album_index');
    }


    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Album $album
     * @return Response
     */
    public function delete(Request $request, Album $album): Response
    {
        if ($this->isCsrfTokenValid('delete'.$album->getId(), $request->request->get('_token'))) {
            $this->em->remove($album);
            $this->em->flush();
        }

        return $this->redirectToRoute('admin_album_index');
    }
}
