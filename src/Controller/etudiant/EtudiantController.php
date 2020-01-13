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
        $user = $this->getUser();
        return $this->render('etudiant/profile_etudiant.html.twig', [
            "etud" => $user,


        ]);
    }

    /**
     * @Route("/etudiant/coordonne/{id<\d+>}", name="etudiant.coordonnee")
     */
    public function Affiche_Cordonne(Etudiant $etudiant = null)
    {


        return $this->render('etudiant/coordonnées.html.twig', [
            "etud" => $etudiant

        ]);
    }


}
