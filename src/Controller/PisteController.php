<?php

namespace App\Controller;

use App\Entity\Piste;
use App\Form\PisteType;
use App\Repository\PisteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/piste")
 */
class PisteController extends AbstractController
{
    /**
     * @Route("/", name="piste_index", methods={"GET"})
     */
    public function index(PisteRepository $pisteRepository): Response
    {
        return $this->render('piste/index.html.twig', [
            'pistes' => $pisteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="piste_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $piste = new Piste();
        $form = $this->createForm(PisteType::class, $piste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($piste);
            $entityManager->flush();

            return $this->redirectToRoute('piste_index');
        }

        return $this->render('piste/new.html.twig', [
            'piste' => $piste,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="piste_show", methods={"GET"})
     */
    public function show(Piste $piste): Response
    {
        return $this->render('piste/show.html.twig', [
            'piste' => $piste,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="piste_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Piste $piste): Response
    {
        $form = $this->createForm(PisteType::class, $piste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('piste_index');
        }

        return $this->render('piste/edit.html.twig', [
            'piste' => $piste,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="piste_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Piste $piste): Response
    {
        if ($this->isCsrfTokenValid('delete'.$piste->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($piste);
            $entityManager->flush();
        }

        return $this->redirectToRoute('piste_index');
    }
}
