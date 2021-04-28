<?php

namespace App\Form;

use App\Entity\Articles;
use Brokoskokoli\StarRatingBundle\Form\RatingType;
use Brokoskokoli\StarRatingBundle\Form\StarRatingType;
use Brokoskokoli\StarRatingBundle\StarRatingBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class ArticlesnewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreArt')
            ->add('auteurArt')
            ->add('descriptionArt')
//            ->add('dateArt',Datetype::class)
            // ->add('likes')
            ->add('photo',FileType::class,array('label'=>'inserer une image',
                'data_class' => null))
            ->add('idCat')


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
