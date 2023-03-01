<?php

namespace App\Form;

use App\Entity\Castle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CastleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'required' => true,
                'label' => 'Nom du chateau',
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'Description du chateau',
            ])
            ->add('picture', TextType::class, [
                'required' => true,
                'label' => 'Image du chateau',
            ])
        ;
    }//

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Castle::class,
        ]);
    }
}
