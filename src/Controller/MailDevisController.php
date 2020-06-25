<?php

namespace App\Controller;

use App\Repository\DevisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailDevisController extends AbstractController
{
    /**
     * @Route("/mail/devis/{id}", name="mail")
     */
    public function index(DevisRepository $repo, $id)
    {
        $devis = $repo->find($id);

        return $this->render('mail_devis/index.html.twig', [
            'devis' => $devis
        ]);
    }
}
