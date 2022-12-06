<?php

namespace App\Form;

use App\Document\Userone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
// use FOS\CKEditorBundle\Form\Type\CKEditorType; // para llamar el bundle que instala el editor
// ? check more info in https://symfony.com/bundles/FOSCKEditorBundle/current/usage/config.html

class Loguin extends AbstractType
{


  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('email',  EmailType::class)
      ->add('password', PasswordType::class);
      // ->add('htmlarea', CKEditorType::class); // for install ckeditor


  }

}