<?php

namespace App\Controller\enseignant;

use App\Entity\Enseignant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ENSEIGNANT")
 */
class EnseignantController extends AbstractController
{
    /**
     * @Route("/enseignant/{id}", name="enseignant")
     */
    public function index(Enseignant $enseignant = null)
    {
        $manager = $this->getDoctrine()->getRepository(Enseignant::class);
        return $this->render('enseignant/index.html.twig', [
            'ensg' => $enseignant
        ]);
    }
}
