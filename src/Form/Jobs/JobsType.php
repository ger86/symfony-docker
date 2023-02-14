<?php

namespace App\Form\Jobs;

use App\CustomHelper\Languaje\GetLanguaje;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobsType extends AbstractType
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
        // dd($options['attr'][0]);
    $haveDatatoEddit = count($options['attr']) != 0 ? true : false;

    // dd($haveDatatoEddit);
    $languaje = $this->languaje->getAllLanguaje();


    foreach ($languaje->toArray() as $key => $value) {
      $this->listLanguaje[$value] = $value;
    }

    $builder->add('datename',  TextType::class, [
      'attr' => [
        'title'       => 'Title for Jobs',
        'placeholder' => 'add title date and name of jobs',
         'value'       => $haveDatatoEddit ? $options['attr']['dateName'] : ''
      ]
    ])
      ->add('title',  TextType::class, [
        'attr' => [
          'title'       => 'Title for this job',
          'placeholder' => 'add title of section',
           'value'       => $haveDatatoEddit == true ? $options['attr']['title'] : ''
        ]
      ])
      ->add('htmlarea', CKEditorType::class, [
         'data' =>  $haveDatatoEddit ? $options['attr']['description'] : ''
      ])
      ->add('languaje', ChoiceType::class, [
        'attr' => [
          'title' => 'Languaje'
        ],
        'choices'  => [
          $haveDatatoEddit == true ? $options['attr']['lang'] : ''
          => $haveDatatoEddit ? $options['attr']['lang'] : '', ...$this->listLanguaje
        ],
      ])
      ->add('id', HiddenType::class, [
         'attr' => [ 'value' => $haveDatatoEddit ? $options['attr']['id'] : '' ]
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      // Configure your form options here
    ]);
  }
}
