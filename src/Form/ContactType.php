<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'constraints'=>[
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'minimum {{ limit }} characters atendu',
                        'maxMessage' => 'maximum {{ limit }} characters atendu',
                        ])
                ]
            ])
            ->add('email',EmailType::class,[
                'constraints' => [
                    new Email([
                        'message' => 'L\'email doit être valid.'

                    ])
                ]

            ])
            ->add('phone',TelType::class)
            ->add('subject')
            ->add('message', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
