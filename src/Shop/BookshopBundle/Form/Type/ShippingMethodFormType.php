<?php

namespace Shop\BookshopBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class ShippingMethodFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $check = $options['data']['1']==null ? 1 : $options['data']['1'] ;
        
        $builder->add('shippingMethod',
                        'entity', 
                        array(
                        'class' => 'ShopBookshopBundle:ShippingMethod',
                        'required' => true,
                        'expanded' => true,
                        'data' => $this->em->getReference("ShopBookshopBundle:ShippingMethod", $check)    
                        ))
                        ;
    }

    public function getName()
    {
        return 'shipping_method_form_type';
    }
    
    public function __construct($em) {
        $this->em = $em;
    }
}