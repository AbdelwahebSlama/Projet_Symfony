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
        $etud = $manager->getRepository(Etudiant::class)->find(761);

        return $this->render('etudiant/profile_etudiant.html.twig', [
            "etud" => $etud

        ]);
    }

    /**
     * @Route("/etudiant/coordonne", name="etudiant.coordonnee")
     */
    public function Affiche_Cordonne()
    {
        $manager = $this->getDoctrine()->getManager();
        $etud = $manager->getRepository(Etudiant::class)->find(761);

        return $this->render('etudiant/coordonnées.html.twig', [
            "etud" => $etud

        ]);
    }


}
