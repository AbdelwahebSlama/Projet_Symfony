<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/indexadmin.html.twig', [

        ]);
    }

    /**
     * @Route("/listeEnsg", name="adminListeEnsg")
     */
    public function listeEnseignant()
    {
//        $repo = $this->getDoctrine()->getRepository(Enseignant::class);
//        $ensg = $repo->findAll();
//
//
////        $repo = $this->getDoctrine()->getRepository(Enseignant::class);
////        $ensg = $repo->findAll();
        return $this->render('admin/Enseignant/listeEnseingnat.html.twig', array());

    }
//    /**
//     * @Route("/detail/{id<\d+>}", name="enseignant.detail")
//     */
//    public function detailEnseignat(Enseignant $enseignant = null)
//    {
//
//        return $this->render('admin/Enseignant/detailEnseingnat.html.twig', array(
//            'ensg'=>$enseignant
//        ));
//
//    }
    /**
     * @Route("/delete/{id<\d+>}", name="enseignant.delete")
     */
    public function deletePersonne(Enseignant $enseignant = null)
    {
//        if ($enseignant) {
//            $manager = $this->getDoctrine()->getManager();
//            $manager->remove($enseignant);
//            $manager->flush();
//        }
        return $this->forward('App\Controller\Admin\AdminController::listeEnseignant');
    }

    /**
     * @Route("/ajoutEnsg", name="adminAjoutEnsg")
     */
    public function ajouterEnseignant()
    {
        return $this->render('admin/Enseignant/ajoutEnseignant.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    /**
     * @Route("/listeEtud", name="adminListeEtud")
     */
    public function listeEtudiant()
    {
//        $repo = $this->getDoctrine()->getRepository(Etudiant::class);
//        $etud = $repo->findAll();

        return $this->render('admin/Etudiant/listeEtudiant.html.twig', [

        ]);
    }
    /**
     * @Route("/detailEtud/{id<\d+>}", name="etudiant.detail")
     */
//    public function detailEtudiant(Etudiant $etudiant = null)
//    {
//
//        return $this->render('admin/Etudiant/DetailEtudiant.html.twig', array(
//            'etud'=>$etudiant
//        ));
//
//    }
    /**
     * @Route("/deleteEtud/{id<\d+>}", name="etudiant.delete")
     */
    public function deleteEtudiant(Etudiant $etudiant = null)
    {
//        if ($etudiant) {
//            $manager = $this->getDoctrine()->getManager();
//            $manager->remove($etudiant);
//            $manager->flush();
//        }
        return $this->forward('App\Controller\Admin\AdminController::listeEtudiant');
    }


    /**
     * @Route("/ajoutEtud", name="adminAjoutEtud")
     */
    public function ajouterEtudiant()
    {
        return $this->render('admin/Etudiant/ajoutEtudiant.html.twig', [
            'controller_name' => 'AdminController',
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
