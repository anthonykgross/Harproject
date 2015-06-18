<?php

namespace Harproject\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Harproject\AppBundle\Entity\Group;

class GroupType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $groups = array();
        foreach(Group::$basic_roles as $g){
            $groups[$g] = $g;
        }
        
        $builder
            ->add('label')
            ->add('roles', 'choice', array(
                'choices'  => $groups,
                'expanded' => true,
                'multiple' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Harproject\AppBundle\Entity\Group'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'harproject_appbundle_group';
    }
}
