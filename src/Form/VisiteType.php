<?php

namespace App\Form;

use App\Entity\Visite;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('motif')
            ->add('interrogatoire', CKEditorType::class)
            ->add('examen', CKEditorType::class)
            ->add('conclusion', CKEditorType::class)
            ->add('dateVisiteAt', DateType::class, [
                'widget'    => 'single_text',
                'required'  => true
            ])
            ->add('cas')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Visite::class,
        ]);
    }
}
