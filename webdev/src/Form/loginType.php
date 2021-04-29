<?php

namespace App\Form;
use App\Entity\login;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class loginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',EmailType::class,[
                    'attr'=>[
                        'id' => 'exampleInputEmail1'
                    ]
                ]
            )
            ->add('password' ,PasswordType::class,[
                'attr'=>[
                    'id' => 'exampleInputPassword1'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => login::class,
        ]);
    }
}
