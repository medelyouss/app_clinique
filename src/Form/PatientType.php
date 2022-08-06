<?php

namespace App\Form;

use App\Entity\Patient;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomprenom')
            ->add('dateNaissanceAt', DateType::class, [
                'widget'    => 'single_text',
                'required'  => true
            ])
            //->add('sexe')
            ->add('sexe', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices' => [
                    'Masculin'                     => 'm',
                    'Feminin'                  => 'f',
                ],
            ])
            ->add('domicile')
            ->add('tel')
            ->add('profession')
            ->add('numeroIdentification')
            //->add('createdAt')
            ->add('observations', CKEditorType::class)
            ->add('situationmaritale')
            ->add('telfix')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
