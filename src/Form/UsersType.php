<?php

namespace App\Form;

use App\Entity\locations;
use App\Entity\posts;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('role')
            ->add('password')
            ->add('birthdate')
            ->add('description')
            ->add('status')
            ->add('instagram')
            ->add('linkedin')
            ->add('facebook')
            ->add('twitter')
            ->add('bannerpic')
            ->add('profilepic')
            ->add('likes', EntityType::class, [
                'class' => posts::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('locations', EntityType::class, [
                'class' => locations::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
