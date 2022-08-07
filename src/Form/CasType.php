<?php

namespace App\Form;

use App\Entity\Cas;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule')
            ->add('dateDebutCasAt', DateType::class, [
                'widget'    => 'single_text',
                'required'  => true
            ])
            ->add('histoireMaladie', CKEditorType::class)
            ->add('remarques', CKEditorType::class)
            ->add('patient')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cas::class,
        ]);
    }
}
