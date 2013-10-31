<?php

namespace Shop\BookshopBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;

class AccountFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', 'text')
                ->add('lastname', 'text')
                ->add('email', 'email')
                ->add('phone', 'text', array(
                    'constraints' => new Length(array('min' => 10)),
                ))
                ->add('username', 'text')
                ->add('gender', 'choice', array(
                'choices' => array('0' => 'Male', '1' => 'Female'),
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                ));
    }
    public function getName()
    {
        return 'account_form_type';
    }
}
