<?php

/**
 * @author Clément Vidal <clementvidalperso@@gmail.com>
 */

namespace Harproject\AppBundle\Entity;

/**
 * Base class for any entity in Haproject.
 * This is mainly used by 
 *  - Harproject\OverrideBundle\EntityManager and 
 *  - Harproject\OverrideBundle\EntityRepository
 * to manage in a "smartest" way creation and deletion of objects based on the presence or not 
 * of the deleted_at field
 */
interface HarprojectInterface 
{

    public function setDeletedAt($deletedAt);
    public function getDeletedAt();
    public function isDeleted();
}