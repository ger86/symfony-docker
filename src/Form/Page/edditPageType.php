<?php

namespace App\Form\Page;

 
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface; 

class EdditPageType extends AbstractType
{ 
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { 
       
        $builder->add('id' , HiddenType::class, [
            'attr' => [
                'value' => $options['attr']['id']
            ]
        ])
           ->add('title', TextType::class,[
            'attr' => [
                'value' => $options['attr']['title']
            ]
        ]) 
        ->add('heroImage', TextType::class,[ 
            'attr' => [
                'value' => $options['attr']['heroImage']
            ]]) 
        ->add('htmlarea', CKEditorType::class, [
                'input_sync' => true,  
                'data' => $options['attr']['htmlarea']
        ]);
    } 
}


 