<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Form\ContactType;
use App\Entity\Contact;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Neved*', 'required' => false,
                'constraints' => new NotBlank()
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail címed*', 'required' => false,
                'constraints' => new NotBlank()
            ])
            ->add('message', TextareaType::class,[
                'label' => 'Üzenet szövege*', 'required' => false,
                'constraints' => new NotBlank()
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Küldés',
                'attr' => [
                    'class' => 'btn btn-primary float-center'
                ]
            ])->getForm();

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
