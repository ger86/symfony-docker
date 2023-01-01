<?php

namespace App\Form\Actions;

use App\PostHelpper\Category\CategorySaver;
use App\Document\Userone;
use App\PostHelpper\Category\GetCategory;
use App\PostHelpper\Languaje\GetLanguaje;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
  use FOS\CKEditorBundle\Form\Type\CKEditorType; 
// ? check more info in https://symfony.com/bundles/FOSCKEditorBundle/current/usage/config.html

class EdditForm extends AbstractType 
{

  private $getCAtegory;
  private $GetCategory;
  private $languaje;

  public function __construct(
    CategorySaver $getCAtegory, 
    GetCategory $GetCategory,
    GetLanguaje $languaje,
    )
  {
      $this->getCAtegory = $getCAtegory;
      $this->GetCategory = $GetCategory;
      $this->languaje = $languaje;
  }


  public function buildForm(FormBuilderInterface $builder, array $options)
  {

       $getData = explode('-',$options['attr']['date']);
       $f = new \DateTime();
       $a = $f->setDate(intval($getData[0]),
       intval($getData[1]),
       intval($getData[2]))->format('Y-m-d');
      
    
  $getCategoryCollection = $this->GetCategory->getAllCategory();
    $languaje = $this->languaje->getAllLanguaje();

    $builder->add('Titulo_del_post',  TextType::class, [
        'attr' => [
            'placeholder' => 'agregar titulo del artículo',
            'value'       => $options['attr']['title'] //"languaje"

        ]]) 
        ->add('FriendlyUrl',  TextType::class, [
          'attr' => [
              'placeholder' => 'seo friendly url',
              'class'       => 'newblog_wrapper-form-left-Furl-input',
              'value'       => $options['attr']['friendlyURL']
          ]]) 
     ->add('htmlarea', CKEditorType::class, [
       
          'input_sync'       => true, //$options['attr']['body']
          'data' =>  $options['attr']['body']
          
       ])
     ->add('languaje', ChoiceType::class, [
        'choices'  => [
          $options['attr']['languaje'] => $options['attr']['languaje'], ...$languaje],
    ])
    ->add('keywords',  TextType::class, [
      'attr' => [ 
          'value'       => $options['attr']['keyworl']
      ]])
    ->add('published_status', ChoiceType::class, [
        'choices'  => [
          $options['attr']['Status'] == 1 ? 'publicado': 'borrador' => $options['attr']['Status'] == 1 ? 'publicado': 'borrador',
            'publicado' => 'publicado',
            'borrador' => 'borrador', 
        ]
    ])
    ->add('featured_Image', TextType::class, [
      'attr'=>[
        'class'=>'newblog_wrapper-form-right-items-imageSelector-input',
        'value' => $options['attr']['imageURL']]])
    ->add('categories', ChoiceType::class, [
      'choices'  => [$options['attr']['category'] => $options['attr']['category'],
      ...$getCategoryCollection],  
  ])
    ->add('publishedAt', DateType::class, [
       'widget' => 'choice',
       'format' => 'dd-MM-yyyy',
         'input' => 'string',
        'data' => $a
    ]);
  
    }
}
 