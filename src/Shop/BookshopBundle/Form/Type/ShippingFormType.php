<?php

namespace Shop\BookshopBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ShippingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('addressDetail', 'text')
                ->add('country', 'country')
                ->add('firstname', 'text')
                ->add('lastname', 'text')
                ->add('email', 'email')
                ->add('shipTo', 'checkbox', 
                        array(
                        'label' => 'Use billing address',
                        'value' => null,
                        'required' => false
                        ))
                        ;
    }

    public function getName()
    {
        return 'shipping_form_type';
    }
}