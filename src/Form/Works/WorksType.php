<?php

namespace App\Form\Works;

use App\CustomHelper\Languaje\GetLanguaje;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorksType extends AbstractType
{
    private $languaje;
    private $listLanguaje;

    public function __construct( 
        GetLanguaje $languaje 
      ) { 
        $this->languaje           = $languaje; 
        $this->listLanguaje       = [];
      }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $haveDatatoEddit = count($options['attr']) != 0 ? true : false;
       //   dd(  $options['attr'] );
 
        $languaje = $this->languaje->getAllLanguaje();


        foreach ($languaje->toArray() as $key => $value) {
            $this->listLanguaje[$value] = $value;
          }

        $builder->add('base',  TextType::class, [
            'attr' => [
              'title'       => 'Base of this work',
              'placeholder' => 'add name of the base of this work',
             'value'       => $haveDatatoEddit == true ? $options['attr']['base'] :'' 
            ]
          ])
          ->add('techs',  TextType::class, [
            'attr' => [
              'title'       => 'List of techs',
              'placeholder' => 'add the list of techs for this work',
              'value'       => $haveDatatoEddit == true ? $options['attr']['techs'] :'' 
            ]
          ])
          ->add('htmlarea', CKEditorType::class, [ 
            'data' =>  $haveDatatoEddit == true ? $options['attr']['htmlarea'] :''  
         ])
         ->add('languaje', ChoiceType::class, [
            'attr' => [
              'title'       => 'Languaje' 
            ],
            'choices'  => [
              $haveDatatoEddit == true ? $options['attr']['lang'] :'' 
               => $haveDatatoEddit == true ? $options['attr']['lang'] :'' 
               , ...$this->listLanguaje
            ],
          ])
         ->add('id', HiddenType::class, [ 'attr' => ['value' => $haveDatatoEddit ? $options['attr']['id'] :''] ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
