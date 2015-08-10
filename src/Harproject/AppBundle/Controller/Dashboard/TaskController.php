<?php

namespace Harproject\AppBundle\Controller\Dashboard;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Harproject\AppBundle\Request\HarprojectRole;

use Harproject\AppBundle\Entity\Task;
use Harproject\AppBundle\Form\TaskType;

/**
 * Task controller.
 */
class TaskController extends Controller
{

    /**
     * Lists all Task entities.
     * @HarprojectRole(role="TASK_VIEW")
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        $entities   = $em->getRepository('HarprojectAppBundle:Task')->findBy(array(
            "project" => $em->getRepository('HarprojectAppBundle:Project')->find($project_id)
        ));
        
        return $this->render('HarprojectAppBundle:Dashboard\Task:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Task entity.
     * @HarprojectRole(role="TASK_ADD")
     */
    public function createAction(Request $request)
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        $project    = $em->getRepository('HarprojectAppBundle:Project')->find($project_id);

        $entity = new Task();
        $entity->setProject($project);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_dashboard_task_show', array('id' => $entity->getId())));
        }

        return $this->render('HarprojectAppBundle:Dashboard\Task:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Task entity.
     *
     * @param Task $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Task $entity)
    {
        $form = $this->createForm(new TaskType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_dashboard_task_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Task entity.
     * @HarprojectRole(role="TASK_ADD")
     */
    public function newAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        $project    = $em->getRepository('HarprojectAppBundle:Project')->find($project_id);
        
        $entity = new Task();
        $entity->setProject($project);
        
        $form   = $this->createCreateForm($entity);

        return $this->render('HarprojectAppBundle:Dashboard\Task:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Task entity.
     * @HarprojectRole(role="TASK_VIEW")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HarprojectAppBundle:Task')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        return $this->render('HarprojectAppBundle:Dashboard\Task:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Task entity.
     * @HarprojectRole(role="TASK_EDIT")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $project_id = $this->get('session')->get('project_id');
        $entity   = $em->getRepository('HarprojectAppBundle:Task')->findOneBy(array(
            "project"   => $em->getRepository('HarprojectAppBundle:Project')->find($project_id),
            "id"        => $id
        ));
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('HarprojectAppBundle:Dashboard\Task:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    /**
    * Creates a form to edit a Task entity.
    *
    * @param Task $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Task $entity)
    {
        $form = $this->createForm(new TaskType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_dashboard_task_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Task entity.
     * @HarprojectRole(role="TASK_EDIT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $project_id = $this->get('session')->get('project_id');
        $entity   = $em->getRepository('HarprojectAppBundle:Task')->findOneBy(array(
            "project"   => $em->getRepository('HarprojectAppBundle:Project')->find($project_id),
            "id"        => $id
        ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_dashboard_task_edit', array('id' => $id)));
        }

        return $this->render('HarprojectAppBundle:Dashboard\Task:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }
    /**
     * Deletes a Task entity.
     * @HarprojectRole(role="TASK_DELETE")
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        
        $project_id = $this->get('session')->get('project_id');
        $entity   = $em->getRepository('HarprojectAppBundle:Task')->findOneBy(array(
            "project"   => $em->getRepository('HarprojectAppBundle:Project')->find($project_id),
            "id"        => $id
        ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('harproject_app_dashboard_task'));
    }

    /**
     * Creates a form to delete a Task entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('harproject_app_dashboard_task_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
