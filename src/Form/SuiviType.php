<?php

namespace App\Form;

use App\Entity\Psycho;
use App\Entity\Simple;
use App\Entity\Suivi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuiviType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,[
                'label'=>'Nom du psy',
                'attr'=>[
                    'placeholder'=>'Nom du psy',
                    'class' => 'form-control'
                ]
            ])
            ->add('client')
            ->add('titreS')
            ->add('dateDs',DateType::class,['widget' => 'single_text'])
            ->add('dateFs',DateType::class,['widget' => 'single_text'])
            ->add('tempsDs',TimeType::class,['widget' => 'single_text'])
            ->add('tempsFs',TimeType::class,['widget' => 'single_text'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Suivi::class,
        ]);
    }
}
