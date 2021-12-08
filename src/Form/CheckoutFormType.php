<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Transporteurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckoutFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $user = $options['user'];


        $builder
            ->add('adresse',EntityType::class,[
                'class' => Adresse::class,
                'required' =>true,
                'choices' => $user->getAdresses(),
                'multiple' =>false,
                'expanded' => true,
            ])
            ->add('transporteur', EntityType::class,[
                'class'=> Transporteurs::class,
                'required'=>true,
                'multiple'=>false,
                'expanded'=> true,
            ])
            ->add('information')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'user'=> array(),
        ]);
    }
}
