<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Toys;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ToysType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tname',TextType::class,[
                'label'=>'Toys Name'
            ])
            ->add('tdesc',TextType::class,[
                'label'=>'Toys Description'
            ])
            ->add('tquan',TextType::class,[
                'label'=>'Toys Quantity'
            ])

            ->add('price')
            ->add('ifile',FileType::class,[
                'required'=>false,
                'label'=> 'Insert an image',
                'mapped'=>false
            ])
            ->add('created',DateTimeType::class,[
                'widget'=>'single_text',
                'required'=>false])
            ->add('cat',EntityType::class,[
                'class'=>Category::class,
                'choice_label'=>'catname'
            ])
            ->add('save',SubmitType::class,[
                'label'=> 'Save'
            ])
        ;
    }
}
