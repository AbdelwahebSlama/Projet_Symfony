<?php

namespace App\Controller\enseignant;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EnseignantController extends AbstractController
{
    /**
     * @Route("/enseignant", name="enseignant")
     */
    public function index()
    {
        return $this->render('enseignant/index.html.twig', [
            'controller_name' => 'EnseignantController',
        ]);
    }
}
