<?php

namespace Harproject\AppBundle\Controller\Dashboard;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Harproject\AppBundle\Request\HarprojectRole;

use Harproject\AppBundle\Entity\TimeTracker;
use Harproject\AppBundle\Form\TimeTrackerType;

/**
 * TimeTracker controller.
 */
class TimeTrackerController extends Controller
{

    /**
     * Lists all TimeTracker entities.
     * @HarprojectRole(role="TIMETRACKER_VIEW")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $project_id = $this->get('session')->get('project_id');
        $entities = $em->getRepository('HarprojectAppBundle:TimeTracker')->findAll();
        
        return $this->render('HarprojectAppBundle:Dashboard\TimeTracker:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TimeTracker entity.
     * @HarprojectRole(role="TIMETRACKER_ADD")
     */
    public function createAction(Request $request)
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        $project    = $em->getRepository('HarprojectAppBundle:Project')->find($project_id);
        
        $entity = new TimeTracker();
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_dashboard_timetracker_show', array('id' => $entity->getId())));
        }

        return $this->render('HarprojectAppBundle:Dashboard\TimeTracker:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TimeTracker entity.
     *
     * @param TimeTracker $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TimeTracker $entity)
    {
        $form = $this->createForm(new TimeTrackerType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_dashboard_timetracker_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TimeTracker entity.
     * @HarprojectRole(role="TIMETRACKER_ADD")
     */
    public function newAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        $project    = $em->getRepository('HarprojectAppBundle:Project')->find($project_id);
        
        $entity = new TimeTracker();
        $form   = $this->createCreateForm($entity);

        return $this->render('HarprojectAppBundle:Dashboard\TimeTracker:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TimeTracker entity.
     * @HarprojectRole(role="TIMETRACKER_VIEW")
     */
    public function showAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        $project    = $em->getRepository('HarprojectAppBundle:Project')->find($project_id);

        $entity = $em->getRepository('HarprojectAppBundle:TimeTracker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeTracker entity.');
        }

        return $this->render('HarprojectAppBundle:Dashboard\TimeTracker:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing TimeTracker entity.
     * @HarprojectRole(role="TIMETRACKER_EDIT")
     */
    public function editAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        $project    = $em->getRepository('HarprojectAppBundle:Project')->find($project_id);

        $entity = $em->getRepository('HarprojectAppBundle:TimeTracker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeTracker entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('HarprojectAppBundle:Dashboard\TimeTracker:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    /**
    * Creates a form to edit a TimeTracker entity.
    *
    * @param TimeTracker $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TimeTracker $entity)
    {
        $form = $this->createForm(new TimeTrackerType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_dashboard_timetracker_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TimeTracker entity.
     * @HarprojectRole(role="TIMETRACKER_EDIT")
     */
    public function updateAction(Request $request, $id)
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        $project    = $em->getRepository('HarprojectAppBundle:Project')->find($project_id);

        $entity = $em->getRepository('HarprojectAppBundle:TimeTracker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeTracker entity.');
        }
        $entity->setUpdatedAt(new \DateTime());
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_dashboard_timetracker_edit', array('id' => $id)));
        }

        return $this->render('HarprojectAppBundle:Dashboard\TimeTracker:edit.html.twig', array(
            'entity'        => $entity,
            'form'          => $editForm->createView()
        ));
    }
    /**
     * Deletes a TimeTracker entity.
     * @HarprojectRole(role="TIMETRACKER_DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        $project    = $em->getRepository('HarprojectAppBundle:Project')->find($project_id);
        
        $entity = $em->getRepository('HarprojectAppBundle:TimeTracker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeTracker entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('harproject_app_dashboard_timetracker'));
    }
}
