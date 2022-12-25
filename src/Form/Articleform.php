<?php

namespace App\Form;

use App\PostMetadata\Category\CategorySaver;
use App\Document\Userone;
use App\PostMetadata\Category\GetCategory;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
  use FOS\CKEditorBundle\Form\Type\CKEditorType; 
// ? check more info in https://symfony.com/bundles/FOSCKEditorBundle/current/usage/config.html

class Articleform extends AbstractType 
{

  private $getCAtegory;
  private $GetCategory;

  public function __construct(CategorySaver $getCAtegory, GetCategory $GetCategory)
  {
      $this->getCAtegory = $getCAtegory;
      $this->GetCategory = $GetCategory;
  }


  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $getCategoryCollection = $this->GetCategory->getAllCategory();
    

    $builder->add('Titulo_del_post',  TextType::class, [
        'attr' => [
            'placeholder' => 'agregar titulo del artículo' 
        ]]) 
        ->add('FriendlyUrl',  TextType::class, [
          'attr' => [
              'placeholder' => 'seo friendly url',
              'class'=>'newblog_wrapper-form-left-Furl-input'
          ]]) 
     ->add('htmlarea', CKEditorType::class)
     ->add('languaje', ChoiceType::class, [
        'choices'  => [
            ' ' => null,
            'español' => 'es',
            'ingles' => 'en', 
        ],
    ])
    ->add('keywords',  TextType::class)
    ->add('published_status', ChoiceType::class, [
        'choices'  => [
            ' ' => null,
            'publicado' => 'publicado',
            'borrador' => 'borrador', 
        ]
    ])
    ->add('featured_Image', TextType::class, ['attr'=>['class'=>'newblog_wrapper-form-right-items-imageSelector-input']])
    ->add('categories', ChoiceType::class, [
      'choices'  => [''=>'',...$getCategoryCollection],  
  ])
    ->add('publishedAt', DateType::class, [
      'widget' => 'choice',
      'format' => 'dd-MM-yyyy',
      'data' => new \DateTime()
    ]);
  
    }

    
}

