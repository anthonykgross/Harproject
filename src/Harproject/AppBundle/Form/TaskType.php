<?php

namespace Harproject\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created_at')
            ->add('name')
            ->add('description')
            ->add('estimated_time')
            ->add('spent_time')
            ->add('updated_at')
            ->add('project')
            ->add('author')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Harproject\AppBundle\Entity\Task'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'harproject_appbundle_task';
    }
}
