<?php

namespace App\Form;

use App\Entity\Evenement;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('emplacementEv',null,['required' => false])
            ->add('dateDev')
            ->add('dateFev')
            ->add('tempsDev')
            ->add('tempsFev')
            ->add('ageMin')
            ->add('ageMax')
            ->add( 'image',FileType::class,array('data_class'=>null,'required'=>false))
            #->add('idAct')
        ;}


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}

