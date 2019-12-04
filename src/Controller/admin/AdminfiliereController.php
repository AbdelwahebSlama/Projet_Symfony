<?php

namespace App\Controller\admin;

use App\Entity\Filiere;
use App\Form\FiliereType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminfiliereController extends AbstractController
{


    /**
     * @Route("/admin/listefiliere", name="admin.liste.filiere")
     */
    public function ListeFiliere()
    {
        $manager = $this->getDoctrine()->getManager()->getRepository(Filiere::class);
        $fiel = $manager->findAll();

        return $this->render('admin/Filiere/listefiliere.html.twig', [
            "fiels" => $fiel
        ]);
    }

    /**
     * @Route("/admin/AjouterFiliere", name="admin.filiere.ajout")
     * @Route("/admin/{id}/ModiFiliere", name="admin.modif.fileiere")
     */
    public function AjoutModifStage(Filiere $filiere = null, ObjectManager $manager, Request $request)
    {
        if (!$filiere) {
            $filiere = new Filiere();
        }

        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($filiere);
            $manager->flush();
            return $this->redirectToRoute("admin.liste.filiere");

        }

        return $this->render("admin/Filiere/ajoutFiliere.html.twig", [
            "formfiel" => $form->createView(),
            "Modifiel" => $filiere->getId() !== null
        ]);
    }

}
