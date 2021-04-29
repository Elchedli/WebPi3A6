<?php

namespace App\Form;

use App\Entity\Reclamation;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Form\FormTypeInterface;
class ReclamationType extends AbstractType
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,[
                'attr'=>[
                    'readonly' => true,
                    'value' => $this->session->get("user")
                ]
            ])
            ->add('objRec', null, ['label' => 'Object'])
            ->add('sujRec',  TextareaType::class, ['label' => 'Details'])
            ->add('etatRec', null, ['label' => 'Status'])
 //           ->add('dateRec')
            ->add('idCat', null, ['label' => 'Name Category'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
