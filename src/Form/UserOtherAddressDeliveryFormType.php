<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserOtherAddressDeliveryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, [
                'label' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Miasto jest wymagane.']),
                    new Length(['min' => 2, 'max' => 100, 'minMessage' => 'Miasto powinno zawierać przynajmniej {{ limit }} znaki.', 'maxMessage' => 'Miasto powinno zawierać maksymalnie {{ limit }} znaków.']),
                ],
                'attr' => [
                    'placeholder' => 'Miasto',
                ],
            ])
            ->add('postalCode', TextType::class, [
                'label' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Kod pocztowy jest wymagany.']),
                    new Length(['min' => 5, 'max' => 10, 'minMessage' => 'Kod pocztowy powinien zawierać przynajmniej {{ limit }} znaków.', 'maxMessage' => 'Kod pocztowy powinien zawierać maksymalnie {{ limit }} znaków.']),
                ],
                'attr' => [
                    'placeholder' => 'Kod pocztowy',
                ],
            ])
            ->add('address', TextType::class, [
                'label' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Adres jest wymagany.']),
                    new Length(['min' => 5, 'max' => 255, 'minMessage' => 'Adres powinien zawierać przynajmniej {{ limit }} znaków.', 'maxMessage' => 'Adres powinien zawierać maksymalnie {{ limit }} znaków.']),
                ],
                'attr' => [
                    'placeholder' => 'Adres',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
