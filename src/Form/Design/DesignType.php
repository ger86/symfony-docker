<?php

namespace App\Form\Design;
 
use Symfony\Component\Form\AbstractType; 
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DesignType extends AbstractType
{ 
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
         
        $builder->add('title',  TextType::class, [
            'attr' => [
              'title'       => 'Title for Design',
              'placeholder' => 'add title of section',
              'value'       => '' 
            ]])
          ->add('year', RangeType::class, [
            'attr' => [
                'min' => 1,
                'max' => 8
            ], ])
          ->add('id', HiddenType::class, [ 'attr' => ['value' => ''] ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
