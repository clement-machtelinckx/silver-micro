<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Restaurant;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateTime', null, [
                'widget' => 'single_text',
            ])
            ->add('nbOfGuests', null, [
                'attr' => [
                    'min' => 1,
                    'max' => 10,
                ]
            ])
            ->add('sumbit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4 mb-4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
