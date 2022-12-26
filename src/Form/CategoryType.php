<?php

namespace App\Form;


use App\PostMetadata\Languaje\GetLanguaje;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{

     private $languajes; 

     public function __construct(GetLanguaje $languages)
     {
        $this->languajes = $languages;
     }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        

        $builder->add('category', TextType::class);
    }

     
}
