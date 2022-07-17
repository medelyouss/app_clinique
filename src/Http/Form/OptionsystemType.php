<?php

namespace App\Http\Form;

use App\Principal\Entity\Optionsystem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OptionsystemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('copyright')
            ->add('facebook')
            ->add('twitter')
            ->add('instagram')
            ->add('youtube')
            ->add('tel')
            ->add('email')
            ->add('adresse')
            ->add('urlsiteweb')
            ->add('imgMainlogoFile', FileType::class,[
                'required'    => !$options['update'],
                'multiple' => false,
                'label'     => false
            ])
            ->add('imgMainlogomobileFile', FileType::class,[
                'required'    => !$options['update'],
                'multiple' => false,
                'label'     => false
            ])
            ->add('imgNoimageFile', FileType::class, [
                'required'    => !$options['update'],
                'multiple' => false,
                'label'     => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Optionsystem::class,
        ]);

        $resolver->setRequired([
            'update',
        ]);
    }
}
