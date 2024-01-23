<?php

namespace App\Form\Page;

 
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType; 
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface; 

class PageType extends AbstractType
{ 
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { $builder->add('title', TextType::class) 
        ->add('heroImage', TextType::class) 
        ->add('htmlarea', CKEditorType::class);
    } 
}
