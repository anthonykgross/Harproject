<?php

namespace Harproject\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MemberType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('group', 'entity', array(
                "class" => 'HarprojectAppBundle:Group',
                "property" => 'label',
            ))
            ->add('user', 'entity', array(
                "class" => 'HarprojectAppBundle:User',
                "property" => 'email',
            ))
            ->add('project', 'entity', array(
                "class" => 'HarprojectAppBundle:Project',
                "property" => 'name',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Harproject\AppBundle\Entity\Member'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'harproject_appbundle_member';
    }
}
