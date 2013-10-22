<?php

namespace Shop\BookshopBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('firstname');
        $builder->add('lastname');
        $builder->add('phone');
        $builder->add('gender', 'choice', array(
            'choices' => array("Male", "Female"),
            'expanded' => true,
            'multiple' => false,
            'required' => true,
            'data' => '0'
        ));
    }

    public function getName()
    {
        return 'user_registration';
    }
}
