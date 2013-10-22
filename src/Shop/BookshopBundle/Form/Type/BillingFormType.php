<?php

namespace Shop\BookshopBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BillingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('addressDetail', 'text', array('required'=>false))
                ->add('country', 'country')
                ->add('firstname', 'text')
                ->add('lastname', 'text')
                ->add('email', 'email')
                ->add('shipTo',
                        'choice', 
                        array(
                        'choices' => array(true => 'Ship to this address', false => 'Ship to different address'),
                        'required' => true,
                        'expanded' => true,
                        'data' => true
                        ))
                        ;
    }

    public function getName()
    {
        return 'billing_form_type';
    }
}