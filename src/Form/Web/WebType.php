<?php

namespace App\Form\Web;
 
use Symfony\Component\Form\AbstractType; 
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface; 

class WebType extends AbstractType
{ 
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
         
        $builder->add('title',  TextType::class, [
            'attr' => [
              'title'       => 'Title for Web',
              'placeholder' => 'add title of section',
              'value'       => '' 
            ]])
          ->add('Porcents', RangeType::class, [
            'attr' => [
                'min'  => 10,
                'max'  => 100,
                'step' => 5
            ], ])
          ->add('id', HiddenType::class, [ 'attr' => ['value' => ''] ]);
    }

     
}