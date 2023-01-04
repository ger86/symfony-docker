<?php

namespace App\Form;

use App\PostHelpper\Category\CategorySaver;
use App\Document\Userone;
use App\PostHelpper\Category\GetCategory;
use App\PostHelpper\Languaje\GetLanguaje;
use App\PostHelpper\Status\GetStatus;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
// ? check more info in https://symfony.com/bundles/FOSCKEditorBundle/current/usage/config.html

class Articleform extends AbstractType
{

  // private $getCAtegory;
  private $GetCategory;
  private $languaje;
  private $getStatus;
  private $listCategories;
  private $listLanguaje;
  private $listStatus;

  public function __construct(
    CategorySaver $getCAtegory,
    GetCategory $GetCategory,
    GetLanguaje $languaje,
    GetStatus $getStatus
  ) {
    // $this->getCAtegory = $getCAtegory;
    $this->GetCategory        = $GetCategory;
    $this->languaje           = $languaje;
    $this->getStatus          = $getStatus;
    $this->listCategories     = [];
    $this->listLanguaje       = [];
    $this->listStatus         = [];
  }


  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $getCategoryCollection = $this->GetCategory->getAllCategory();
    $languaje              = $this->languaje->getAllLanguaje();
    $status                = $this->getStatus->getAllStatus();

    foreach ($getCategoryCollection->toArray() as $key => $value) {
      $this->listCategories[$value] = $value;
    }

    foreach ($languaje->toArray() as $key => $value) {
      $this->listLanguaje[$value] = $value;
    }

    foreach ($status->toArray() as $key => $value) {
      $this->listStatus[$value] = $value;
    }


    $builder->add('Titulo_del_post',  TextType::class, [
      'attr' => [
        'placeholder' => 'agregar titulo del artículo'
      ]
    ])
      ->add('FriendlyUrl',  TextType::class, [
        'attr' => [
          'placeholder' => 'seo friendly url',
          'class' => 'newblog_wrapper-form-left-Furl-input'
        ]
      ])
      ->add('htmlarea', CKEditorType::class)
      ->add('languaje', ChoiceType::class, [
        'choices'  => [
          ' ' => '', ...$this->listLanguaje
        ],
      ])
      ->add('keywords',  TextType::class)
      ->add('published_status', ChoiceType::class, [
        'choices'  => [
          ' ' => ' ', ...$this->listStatus
        ]
      ])
      ->add('featured_Image', TextType::class, ['attr' => ['class' => 'newblog_wrapper-form-right-items-imageSelector-input']])
      ->add('categories', ChoiceType::class, [
        'choices'  => ['' => '', ...$this->listCategories],
      ])
      ->add('publishedAt', DateType::class, [
        'widget' => 'choice',
        'format' => 'dd-MM-yyyy',
        'data' => new \DateTime()
      ]);
  }
}
