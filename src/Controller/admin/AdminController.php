<?php

namespace App\Controller\admin;

use App\Entity\Admin;
use App\Entity\Enseignant;
use App\Entity\Etudiant;
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
     * @Route("/listeEnsg", name="adminListeEnsg")
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
     * @Route("/detail/{id<\d+>}", name="enseignant.detail")
     */
    public function detailEnseignat(Enseignant $enseignant = null)
    {

        return $this->render('admin/Enseignant/detailEnseingnat.html.twig', array(
            'ensg' => $enseignant
        ));

    }

    /**
     * @Route("/delete/{id<\d+>}", name="enseignant.delete")
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
     * @Route("/ajoutEnsg", name="adminAjoutEnsg")
     */
    public function ajouterEnseignant(Request $request, ObjectManager $manager)
    {
        $enseignant = new Enseignant();
        $form = $this->createFormBuilder($enseignant)
            ->add('cin')
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('email')
            ->add('image')
            ->add('specialite')
            ->add('CV')
            ->getForm();


        return $this->render('admin/Enseignant/ajoutEnseignant.html.twig', [
            "formEns" => $form->createView()
        ]);
    }


    /**
     * @Route("/listeEtud", name="adminListeEtud")
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
     * @Route("/detailEtud/{id<\d+>}", name="etudiant.detail")
     */
    public function detailEtudiant(Etudiant $etudiant = null)
    {

        return $this->render('admin/Etudiant/DetailEtudiant.html.twig', array(
            'etud' => $etudiant
        ));

    }

    /**
     * @Route("/deleteEtud/{id<\d+>}", name="etudiant.delete")
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
     */
    public function ajouterEtudiant(Request $request, ObjectManager $manager)
    {
        if ($request->request->count() > 0) {
            $etudiant = new Etudiant();

            $etudiant->setCin($request->request->get('cin'))
                ->setNom($request->request->get('nom'))
                ->setPrenom($request->request->get('prenom'))
                ->setAdresse($request->request->get('adresse'))
                ->setEmail($request->request->get('email'))
                ->setImage($request->request->get('image'))
                ->setAge($request->request->get('age'));
            $manager->persist($etudiant);
            $manager->flush();

            return $this->redirectToRoute("etudiant.detail", ['id' => $etudiant->getId()]);

        }

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
