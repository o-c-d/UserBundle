<?php

namespace Ocd\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $formBuilder, array $options): void
    {
        $formBuilder
            ->add('_username', TextType::class, [
                'translation_domain' => 'UserBundle',
                'label' => 'login.username.label',
                'attr' => [
                    'placeholder' => 'login.username.placeholder',
                    'autocomplete' => 'off',
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('_password', PasswordType::class, [
                'translation_domain' => 'UserBundle',
                'label' => 'login.password.label',
                'attr' => [
                    'placeholder' => 'login.password.placeholder',
                    'autocomplete' => 'off',
                ],
            ])
            ->add("login_poney_hot", TextType::class, [
                'required' => false
            ])
        ;
    $formBuilder->setMethod(Request::METHOD_POST);
    }
}
