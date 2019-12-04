<?php

namespace App\Controller\admin;

use App\Entity\Classe;
use App\Entity\Stage;
use App\Form\ClasseType;
use App\Form\StageType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminEcoleController extends AbstractController
{
    /**
     * @Route("/admin/ecole", name="admin_ecole")
     */
    public function index()
    {
        return $this->render('admin_ecole/index.html.twig', [
            'controller_name' => 'AdminEcoleController',
        ]);
    }

    /**
     * @Route("/admin/listeClasse", name="admin.liste.classe")
     */

    public function ListeClass()
    {

        $manager = $this->getDoctrine()->getManager();
        $classe = $manager->getRepository(Classe::class)->findAll();

        return $this->render('admin/Classe/listeClasse.html.twig', [
            "classe" => $classe
        ]);
    }

    /**
     * @Route("/admin/AjouterClasse", name="admin.classe.ajout")
     * @Route("/admin/{id}/ModifClasse", name="admin.modif.classe")
     */
    public function AjoutModifClasse(Classe $classe = null, ObjectManager $manager, Request $request)
    {
        if (!$classe) {
            $classe = new Classe();
        }

        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($classe);
            $manager->flush();
            return $this->redirectToRoute("admin.liste.classe");

        }

        return $this->render("admin/Classe/AjoutClasse.html.twig", [
            "formcl" => $form->createView(),
            "ModifClas" => $classe->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/listeStage", name="admin.liste.stage")
     */

    public function ListeStage()
    {

        $manager = $this->getDoctrine()->getManager();
        $stages = $manager->getRepository(Stage::class)->findAll();
        return $this->render('admin/Stage/listeStage.html.twig', [
            "stages" => $stages
        ]);

    }


    /**
     * @Route("/admin/AjouterStage", name="admin.stage.ajout")
     * @Route("/admin/{id}/ModifStage", name="admin.modif.stage")
     */
    public function AjoutModifStage(Stage $stage = null, ObjectManager $manager, Request $request)
    {
        if (!$stage) {
            $stage = new Stage();
        }

        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($stage);
            $manager->flush();
            return $this->redirectToRoute("admin.liste.stage");

        }

        return $this->render("admin/Stage/AjoutStage.html.twig", [
            "formStg" => $form->createView(),
            "ModifStg" => $stage->getId() !== null
        ]);
    }


}
