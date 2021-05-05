<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil_monProfil")
     */
    public function monProfil(): Response
    {
        return $this->render('profil/monProfil.html.twig', [

        ]);
    }
}
