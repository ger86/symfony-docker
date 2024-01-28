<?php

namespace App\Form\Faqs;

 
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType; 
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface; 

class FaqsType extends AbstractType
{ 
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { $builder->add('question', TextType::class)  
        ->add('response', CKEditorType::class);
    } 
}
