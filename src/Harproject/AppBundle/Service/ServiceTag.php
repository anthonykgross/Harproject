<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */

namespace Harproject\AppBundle\Service;

use \Harproject\AppBundle\Entity\Tag;
use \Harproject\AppBundle\Entity\TimeTracker;
use \Harproject\AppBundle\Entity\Task;
use \Harproject\AppBundle\Entity\Ticket;

use \Harproject\AppBundle\Entity\TaskHasTag;
use \Harproject\AppBundle\Entity\TicketHasTag;
use \Harproject\AppBundle\Entity\TimeTrackerHasTag;

class ServiceTag {
    
    private $em;
    private $container;
    
    public function __construct($container) {
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    /**
     * Get or create a Tag
     * @param String $tag_label
     * @return Tag
     */
    public function getOrCreate($tag_label){
        $tag_label = strtolower($tag_label);
        $tag = $this->em->getRepository("HarprojectAppBundle:Tag")->findOneBy(array(
            "label" => $tag_label,
        ));
        
        if(!$tag){
            $tag = new Tag();
            $tag->setLabel($tag_label);
            $this->em->persist($tag);
            $this->em->flush();
        }
        
        return $tag;
    }
    
    /**
     * Assign a Tag to an object (Task|TimeTracker|Ticket)
     * @param Tag|String $tag
     * @param Task|TimeTracker|Ticket $object
     * @return TaskHasTag|TimeTrackerHasTag|TicketHasTag|NULL
     */
    public function assignTag($tag, $object = null){
        $obj = null;
        
        if($object instanceof Task){
            $obj = new TaskHasTag();
            $obj->setTask($object);
        }
        if($object instanceof TimeTracker){
            $obj = new TimeTrackerHasTag();
            $obj->setTimeTracker($object);
        }
        if($object instanceof Ticket){
            $obj = new TicketHasTag();
            $obj->setTicket($object);
        }
        
        if(!is_null($obj)){
            if($tag instanceof String){
                $tag = $this->getOrCreate($tag);
            }
            $obj->setTag($tag);
            $this->em->persist($obj);
            $this->em->flush();
        }
        return $obj;
    }
    
    /**
     * Remove a Tag from an object (Task|TimeTracker|Ticket)
     * @param Tag $tag
     * @param Task|TimeTracker|Ticket $object
     * @return TaskHasTag|TimeTrackerHasTag|TicketHasTag|NULL
     */
    public function removeTag(Tag $tag, $object = null){
        $obj = null;
        
        if($object instanceof Task){
            $obj = $this->em->getRepository("HarprojectAppBundle:TaskHasTag")->findOneBy(array(
                "tag"           => $tag,
                "task"          => $object
            ));
        }
        if($object instanceof TimeTracker){
            $obj = $this->em->getRepository("HarprojectAppBundle:TimeTrackerHasTag")->findOneBy(array(
                "tag"           => $tag,
                "timeTracker"   => $object
            ));
        }
        if($object instanceof Ticket){
            $obj = $this->em->getRepository("HarprojectAppBundle:TicketHasTag")->findOneBy(array(
                "tag"           => $tag,
                "ticket"        => $object
            ));
        }
        
        if(!is_null($obj)){
            $this->em->remove($obj);
            $this->em->flush();
        }
        return $obj;
    }
}