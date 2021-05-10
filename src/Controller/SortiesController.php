<?php

namespace App\Controller;

use App\Entity\Sorties;
use App\Form\SortiesType;
use App\Repository\SortiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sorties")
 */
class SortiesController extends AbstractController
{
    /**
     * @Route("/", name="sorties_index", methods={"GET"})
     */
    public function index(SortiesRepository $sortiesRepository): Response
    {
        return $this->render('sorties/index.html.twig', [
            'sorties' => $sortiesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sorties_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sorty = new Sorties();
        $form = $this->createForm(SortiesType::class, $sorty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sorty);
            $entityManager->flush();

            return $this->redirectToRoute('sorties_index');
        }

        return $this->render('sorties/new.html.twig', [
            'sorty' => $sorty,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sorties_show", methods={"GET"})
     */
    public function show(Sorties $sorty): Response
    {
        return $this->render('sorties/show.html.twig', [
            'sorty' => $sorty,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sorties_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sorties $sorty): Response
    {
        $form = $this->createForm(SortiesType::class, $sorty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sorties_index');
        }

        return $this->render('sorties/edit.html.twig', [
            'sorty' => $sorty,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sorties_delete", methods={"POST"})
     */
    public function delete(Request $request, Sorties $sorty): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sorty->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sorty);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sorties_index');
    }
}
