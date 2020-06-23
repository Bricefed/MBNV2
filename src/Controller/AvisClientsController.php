<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AvisClientsController extends AbstractController
{
    /**
     * @Route("/avis_clients", name="avis")
     */
    public function index()
    {
        return $this->render('avis_clients/index.html.twig', [
            "nav_activ" => 'avisClients',
        ]);
    }
}
