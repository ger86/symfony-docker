<?php

namespace App\Form\Faqs;

 
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface; 

class EdditFaqType extends AbstractType
{ 
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { 
       
        $builder->add('id' , HiddenType::class, [
            'attr' => [
                'value' => $options['attr']['id']
            ]
        ])
           ->add('question', TextType::class,[
            'attr' => [
                'value' => $options['attr']['question']
            ]
        ])  
        ->add('response', CKEditorType::class, [
                'input_sync' => true,  
                'data' => $options['attr']['response']
        ]);
    } 
}


 