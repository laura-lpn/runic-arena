<?php

namespace App\Form;

use App\Entity\Card;
use App\Entity\ClassCard;
use App\Entity\TypeCard;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('power', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9
                ],
                'expanded' => true
            ])
            ->add('class', EntityType::class, [
                'class' => ClassCard::class,
                'choice_label' => 'name',
                'expanded' => true,
            ])
            ->add('type', EntityType::class, [
                'class' => TypeCard::class,
                'choice_label' => 'name',
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Card::class,
        ]);
    }
}
