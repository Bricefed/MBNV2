<?php

namespace App\Controller;

use App\Repository\DevisRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DevisAdminController extends AbstractController
{
    /**
     * @Route("/admin/devis", name="devisClients")
     */
    public function index(DevisRepository $repo)
    {
        $devis = $repo->findAll();

        return $this->render('devis_admin/index.html.twig', [
            'devis' => $devis,
        ]);
    }
}
