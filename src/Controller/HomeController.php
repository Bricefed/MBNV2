<?php

namespace App\Controller;

use App\Repository\DevisRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DevisRepository $repo)
    {
        $devis = $repo->findAll();

        return $this->render('home/index.html.twig',[
            "nav_activ" => 'home',
            'devis' => $devis
        ]);
    }
}
