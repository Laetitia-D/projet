<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Form\CampusType;
use App\Repository\CampusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampusController extends AbstractController
{

    /**
     * @Route("/campus", name="campus_afficherCampus")
     */
    public function afficherCampus(CampusRepository $campusRepository): Response
    {
        $campus = $campusRepository->findAll();

        return $this->render('campus/afficherCampus.html.twig', [
            "Campus" => $campus
        ]);
    }

    /**
     * @Route("/campus/add", name="campus_ajouterCampus")
     */
    public function ajouterCampus(Request $request, EntityManagerInterface $entityManager ): Response
    {
        $campus = new Campus();
        $campusForm = $this->createForm(CampusType::class, $campus);

        $campusForm->handleRequest($request);

        if ($campusForm->isSubmitted() && $campusForm->isValid()){
            $entityManager->persist($campus);
            $entityManager->flush();

            $this->addFlash('success', 'Campus ajouté !');
            return $this->redirectToRoute('campus_ajouterCampus');
        }

        return $this->render('campus/ajouterCampus.html.twig', [
            'CampusForm' => $campusForm->createView()
        ]);
    }

    /**
     * @Route("/campus/{id}/modifier", name="campus_modifierCampus")
     */
    public function modifierCampus(Request $request, Campus $campus): Response
    {
        $campusForm = $this->createForm(CampusType::class, $campus);
        $campusForm->handleRequest($request);

        if ($campusForm->isSubmitted() && $campusForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Campus modifier !');
            return $this->redirectToRoute('campus_modifierCampus');
        }

        return $this->render('campus/modifierCampus.html.twig', [
            'campus' => $campus,
            'form' => $campusForm->createView(),
        ]);
    }

    /**
     * @Route("/campus/{id}", name="campus_supprimerCampus")
     */
    public function supprimer(Request $request, Campus $campus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$campus->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($campus);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Campus supprimer !');
        return $this->redirectToRoute('campus_afficherCampus');
    }
}
