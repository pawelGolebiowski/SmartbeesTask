<?php

namespace App\Form;

use App\Entity\UserData;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class UserDataFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Login',
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Login jest wymagany.']),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Hasła muszą się zgadzać.',
                'required' => true,
                'first_options' => [
                    'attr' => [
                        'placeholder' => 'Hasło',
                    ],
                    'label' => false,
                    'constraints' => [
                        new NotBlank(['message' => 'Hasło jest wymagane.']),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Hasło musi mieć co najmniej {{ limit }} znaków.',
                            'max' => 4096, // maksymalna długość obsługiwana przez silnik bcrypt
                        ]),
                    ],
                ],
                'second_options' => [
                    'attr' => [
                        'placeholder' => 'Powtórz hasło',
                    ],
                    'label' => false,
                ],
            ])
            ->add('firstName', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Imię',
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Imię jest wymagane.']),
                ],
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nazwisko',
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Nazwisko jest wymagane.']),
                ],
            ])
            ->add('country', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Kraj',
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Kraj jest wymagany.']),
                ],
            ])
            ->add('address', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Adres',
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Adres jest wymagany.']),
                ],
            ])
            ->add('postalCode', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Kod pocztowy',
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Kod pocztowy jest wymagany.']),
                    new Regex([
                        'pattern' => '/^\d{2}-\d{3}$/',
                        'message' => 'Kod pocztowy powinien być w formacie XX-XXX.',
                    ]),
                ],
            ])
            ->add('city', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Miasto',
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Miasto jest wymagane.']),
                ],
            ])
            ->add('phone', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Telefon',
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Telefon jest wymagany.']),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'custom-button',
                ],
                'label' => 'Potwierdź',
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'homepage',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserData::class,
        ]);
    }
}
