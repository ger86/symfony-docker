<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\OptionsResolver\OptionsResolver;

class LanguajeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('languaje', TextType::class);
    }

     
}
