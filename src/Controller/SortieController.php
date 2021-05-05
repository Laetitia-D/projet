<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/sortie", name="sortie_gererSortie")
     */
    public function gererSortie(): Response
    {
        return $this->render('sortie/gererSortie.html.twig', [

        ]);
    }
}
