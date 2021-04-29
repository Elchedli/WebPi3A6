<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Invitation;
use App\Entity\Simple;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Invitation1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idUser', EntityType::class, [
                'class' => Simple::class,
                'choice_label' => function ($Simple) {
                    return $Simple->getUsername();
                }
            ])
            ->add('idEv', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' => function ($Evenement) {
                    return $Evenement->getTitreEv();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invitation::class,
        ]);
    }
}
