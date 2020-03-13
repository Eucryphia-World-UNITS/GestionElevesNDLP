<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('Sexe')
            ->add('BirthDate')
            ->add('Status')
            ->add('Lv2')
            ->add('Note')
            ->add('Arrangement')
            ->add('etablissement_origine')
            ->add('classe')
            ->add('enseignement_comp')
            ->add('courOptions')
            ->add('specialisations')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
