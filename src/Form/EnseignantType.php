<?php

namespace App\Form;

use App\Entity\Enseignant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin')
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('email')
            ->add('image', FileType::class, array(
                'label' => 'Choissiez votre image type JPG ',
                'data_class' => null,))
            ->add('specialite')
            ->add('CV', FileType::class, array(
                'label' => 'Choissiez votre fichier ',
                'data_class' => null,

            ))
            ->add('password')
            ->add('Ecole');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enseignant::class,
        ]);
    }
}
