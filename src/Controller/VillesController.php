<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VillesController extends AbstractController
{
    /**
     * @Route("/villes", name="villes_gererVilles")
     */
    public function gererVilles(): Response
    {
        return $this->render('villes/gererVilles.html.twig', [

        ]);
    }
}
