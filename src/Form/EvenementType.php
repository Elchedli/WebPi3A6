<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder-> setAction($options['action'])
            ->add('titreEv')
            ->add('typeEv', ChoiceType::class, array(
                'choices' => array(
                    'sportif'=>'sportif',
                    'educatif'=>'educatif',
                    'loisir'=>'loisir',
                )))
            ->add('emplacementEv')
            ->add('dateDev')
            ->add('dateFev')
            ->add('tempsDev')
            ->add('tempsFev')
            ->add('ageMin')
            ->add('ageMax')
            #->add('idAct')
        ;}


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}

