<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MeublesController extends AbstractController
{
    /**
     * @Route("/meubles", name="meubles")
     */
    public function index()
    {
        return $this->render('meubles/index.html.twig',[
            "nav_activ" => 'meubles',
        ]);
    }
}
