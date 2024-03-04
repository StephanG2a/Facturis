<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Quote;
use App\Entity\Service;
use App\Entity\Invoice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('totalPrice', NumberType::class)
            ->add('taxAmount', NumberType::class)
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Pending' => 'pending',
                    'Paid' => 'paid',
                    'Cancelled' => 'cancelled',
                ],
            ])
            ->add('issueDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('dueDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'companyName',
            ])
            ->add('services', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
            ])
            ->add('quote', EntityType::class, [
                'class' => Quote::class,
                'choice_label' => function ($quote) {
                    return $quote->getId() . ' - ' . $quote->getClient()->getCompanyName();
                },
                'required' => false, // Make it optional if the invoice might not always be linked to a quote
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
