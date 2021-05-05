<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampusController extends AbstractController
{
    /**
     * @Route("/campus", name="campus_gererCampus")
     */
    public function gererCampus(): Response
    {
        return $this->render('campus/gererCampus.html.twig', [

        ]);
    }
}
