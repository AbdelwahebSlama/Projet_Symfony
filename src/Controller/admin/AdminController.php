<?php

namespace App\Controller\admin;

use App\Entity\Admin;
use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Form\EnseignantType;
use App\Form\EtudiantType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $manager = $this->getDoctrine()->getManager();
        $admin = $manager->getRepository(Admin::class)->find(2);

        return $this->render('admin/indexadmin.html.twig', [
            "admin" => $admin

        ]);
    }

    /**
     * @Route("/admin/listeEnsg", name="adminListeEnsg")
     */
    public function listeEnseignant()
    {
        $repo = $this->getDoctrine()->getRepository(Enseignant::class);
        $ensg = $repo->findAll();


//        $repo = $this->getDoctrine()->getRepository(Enseignant::class);
//        $ensg = $repo->findAll();
        return $this->render('admin/Enseignant/listeEnseingnat.html.twig', array(
            "ensg" => $ensg
        ));

    }

    /**
     * @Route("/admin/detail/{id<\d+>}", name="enseignant.detail")
     */
    public function detailEnseignat(Enseignant $enseignant = null)
    {

        return $this->render('admin/Enseignant/detailEnseingnat.html.twig', array(
            'ensg' => $enseignant
        ));

    }

    /**
     * @Route("/admin/delete/{id<\d+>}", name="enseignant.delete")
     */
    public function deletePersonne(Enseignant $enseignant = null)
    {
        if ($enseignant) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($enseignant);
            $manager->flush();
        }
        return $this->forward('App\Controller\Admin\AdminController::listeEnseignant');
    }

    /**
     * @Route("/admin/ajoutEnsg", name="adminAjoutEnsg")
     * @Route("/admin/{id}/ModifEns", name="adminModifiEnsg")
     */
    public function ajouterEnseignant(Enseignant $enseignant = null, Request $request, ObjectManager $manager)
    {
        if (!$enseignant) {
            $enseignant = new Enseignant();
        }

        $form = $this->createForm(EnseignantType::class, $enseignant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($enseignant);
            $manager->flush();
            return $this->redirectToRoute('enseignant.detail', ['id' =>
                $enseignant->getId()]);
        }
        return $this->render('admin/Enseignant/ajoutEnseignant.html.twig', [
            "formEns" => $form->createView(),
            "modifEns" => $enseignant->getId() !== null
        ]);
    }


    /**
     * @Route("/admin/listeEtud", name="adminListeEtud")
     */
    public function listeEtudiant()
    {
        $repo = $this->getDoctrine()->getRepository(Etudiant::class);
        $etud = $repo->findAll();

        return $this->render('admin/Etudiant/listeEtudiant.html.twig', [
            "etud" => $etud

        ]);
    }

    /**
     * @Route("/admin/detailEtud/{id<\d+>}", name="etudiant.detail")
     */
    public function detailEtudiant(Etudiant $etudiant = null)
    {

        return $this->render('admin/Etudiant/DetailEtudiant.html.twig', array(
            'etud' => $etudiant
        ));

    }

    /**
     * @Route("/admin/deleteEtud/{id<\d+>}", name="etudiant.delete")
     */
    public function deleteEtudiant(Etudiant $etudiant = null)
    {
        if ($etudiant) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($etudiant);
            $manager->flush();
        }
        return $this->forward('App\Controller\Admin\AdminController::listeEtudiant');
    }


    /**
     * @Route("/admin/ajoutEtud", name="adminAjoutEtud")
     * @Route("/admin/{id}/ModifEtud", name="adminModifiEtud")
     */
    public function ajouterEtudiant(Etudiant $etudiant = null, Request $request, ObjectManager $manager)
    {

        if (!$etudiant) {
            $etudiant = new Etudiant();
        }

        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($etudiant);
            $manager->flush();

            return $this->redirectToRoute('etudiant.detail', ['id' =>
                $etudiant->getId()]);
        }
        return $this->render('admin/Etudiant/ajoutEtudiant.html.twig', [
            "formEtud" => $form->createView(),
            "modifEtud" => $etudiant->getId() !== null

        ]);
    }

    /**
     * @Route("/listeMat", name="adminListeMat")
     */
    public function listeMatiere()
    {
//        $repo = $this->getDoctrine()->getRepository(Matiere::class);
//        $matiere = $repo->findAll();

        return $this->render('admin/Matiere/listeMatiere.html.twig', [

        ]);
    }

    /**
     * @Route("/ajoutMat", name="adminAjoutMat")
     */
    public function ajouterMatiere()
    {
        return $this->render('admin/Matiere/ajoutMatiere.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


}
