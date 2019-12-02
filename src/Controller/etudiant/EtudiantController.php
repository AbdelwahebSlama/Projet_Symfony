<?php

namespace App\Controller\etudiant;

use App\Entity\Etudiant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function index()
    {
        $manager = $this->getDoctrine()->getManager();
        $etud = $manager->getRepository(Etudiant::class)->find(1);

        return $this->render('etudiant/index.html.twig', [
            'etud' => $etud,
        ]);
    }


}
