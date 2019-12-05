<?php

namespace App\Controller\admin;

use App\Entity\Filiere;
use App\Entity\Niveau;
use App\Entity\Type;
use App\Form\FiliereType;
use App\Form\NiveauType;
use App\Form\TypeForm;
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


    /**
     * @Route("admin/typeStage", name="admin.type.liste")
     */
    public function Listetype()
    {
        $mamanager = $this->getDoctrine()->getManager()->getRepository(Type::class);
        $types = $mamanager->findAll();

        return $this->render('admin/TypeNiveau/listetype.html.twig', [
            "types" => $types
        ]);
    }

    /**
     * @Route("admin/ajoutertypeStage", name="admin.ajout.type")
     * @Route("admin/{id}/modifType" , name="admin.modif.type")
     */

    public function Ajout_Modif_Type(Type $type = null, Request $request, ObjectManager $manager)
    {
        if (!$type) {
            $type = new Type();
        }
        $form = $this->createForm(TypeForm::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($type);
            $manager->flush();
            return $this->redirectToRoute("admin.type.liste");

        }

        return $this->render("admin/TypeNiveau/Ajoutertype.html.twig", [
            "formTy" => $form->createView(),
            "Modiftype" => $type->getId()

        ]);
    }

    /**
     * @Route("admin/listeniveau", name="admin.liste.niveau")
     */
    public function listeNiveau()
    {

        $mamanager = $this->getDoctrine()->getManager()->getRepository(Niveau::class);
        $niveau = $mamanager->findAll();

        return $this->render('admin/TypeNiveau/listeniveau.html.twig', [
            "niveau" => $niveau
        ]);
    }


    /**
     * @Route("admin/ajouterniveau", name="admin.ajout.niveau")
     * @Route("admin/{id}/modifNiveau" , name="admin.modif.niveau")
     */

    public function Ajout_Modif_Niveau(Niveau $niveau = null, Request $request, ObjectManager $manager)
    {
        if (!$niveau) {
            $niveau = new Niveau();
        }
        $form = $this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($niveau);
            $manager->flush();
            return $this->redirectToRoute("admin.liste.niveau");

        }

        return $this->render("admin/TypeNiveau/AjouterNiveau.html.twig", [
            "form" => $form->createView(),
            "Modif" => $niveau->getId()

        ]);
    }

}
