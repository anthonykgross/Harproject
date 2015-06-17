<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\AppBundle\Entity\Harproject;

/**
 * RelationType
 *
 * @ORM\Table(name="harp_Relation_Type")
 * @ORM\Entity
 */
class RelationType extends Harproject
{

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=32)
     */
    private $label;
    
    /**
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="relationType")
     */
    private $relations;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->relations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set label
     *
     * @param string $label
     * @return RelationType
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Add relations
     *
     * @param \Harproject\AppBundle\Entity\Relation $relations
     * @return RelationType
     */
    public function addRelation(\Harproject\AppBundle\Entity\Relation $relations)
    {
        $this->relations[] = $relations;

        return $this;
    }

    /**
     * Remove relations
     *
     * @param \Harproject\AppBundle\Entity\Relation $relations
     */
    public function removeRelation(\Harproject\AppBundle\Entity\Relation $relations)
    {
        $this->relations->removeElement($relations);
    }

    /**
     * Get relations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRelations()
    {
        return $this->relations;
    }
}
