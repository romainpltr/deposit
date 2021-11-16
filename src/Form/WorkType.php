<?php

namespace App\Form;

use App\Entity\Work;
use App\Entity\Workfile;
use App\Entity\WorkCategory;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class WorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [

            ])
            ->add('description', TextareaType::class)
            ->add('linkedFile', UrlType::class, [
                'required' => false
            ])
            ->add('workCategory', EntityType::class, [
                // looks for choices from this entity
                'class' => WorkCategory::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
            ])        
            ->add('workfiles', CollectionType::class, [
                'entry_type' => WorkfileType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference'  => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Work::class,
        ]);
    }
}
