<?php

namespace App\Form\PrincipalKnowledge;

use App\PostHelpper\Languaje\GetLanguaje;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrincipalKnowledgeType extends AbstractType
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
        
        
        $languaje              = $this->languaje->getAllLanguaje();


        foreach ($languaje->toArray() as $key => $value) {
            $this->listLanguaje[$value] = $value;
          }

        $builder->add('title',  TextType::class, [
            'attr' => [
              'title'       => 'Title for Knowledge',
              'placeholder' => 'add title of section'
            ]
          ])
          ->add('languaje', ChoiceType::class, [
            'attr' => [
              'title'       => 'Languaje' 
            ],
            'choices'  => [
              ' ' => '', ...$this->listLanguaje
            ],
          ])
          ->add('htmlarea', CKEditorType::class)

          ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
