<?php

namespace App\Form\Work;

 
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface; 

class WorkType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('image',  TextType::class, [
            'attr' => [
                'title'       => 'image of this work',
                'placeholder' => 'add name of the image of this work',
                'required'    => true,
                //  'value'       => $haveDatatoEddit == true ? $options['attr']['base'] :'' 
            ]
        ])->add('title',  TextType::class, [
            'attr' => [
                'title'       => 'title of this work',
                'placeholder' => 'add name of the title of this work',
            ]
        ])->add('body', CKEditorType::class, [])
        ->add('tools',  TextType::class, [
            'attr' => [
                'title'       => 'list of tools',
                'placeholder' => 'add names separate by spaces',
            ]
        ])->add('link',  TextType::class, [
            'attr' => [
                'title'       => 'link',
                'placeholder' => 'add link of this work',
            ]
        ])->add('destination',  HiddenType::class, [
            'attr' => [
                'title' => 'link', 
            ]
        ]);
    }
}
