<?php

namespace App\Form;

use App\Entity\Tache;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,[
                'label'=>'Nom du client : ',
                'attr'=>[
                    'placeholder'=>'Client',
                    'class' => 'form-control',
                ]
            ])
            ->add('difficulteTache',TextType::class,[
                'label'=>'Difficultée de la tache : ',
                'attr'=>[
                    'placeholder'=>'Difficultée',
                    'class' => 'form-control',
                ]
            ])

            ->add('descriptionTache',TextType::class,[
                'label'=>'Description du tache : ',
                'attr'=>[
                    'placeholder'=>'Description',
                    'class' => 'form-control',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}
