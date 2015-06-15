<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RelationType
 *
 * @ORM\Table(name="harp_Relation_Type")
 * @ORM\Entity
 */
class RelationType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=32)
     */
    private $label;
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
    
    /**
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="relationType")
     */
    private $relations;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->relations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return RelationType
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
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
