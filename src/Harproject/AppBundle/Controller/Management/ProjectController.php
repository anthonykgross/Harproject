<?php

namespace Harproject\AppBundle\Controller\Management;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Form\ProjectType;

/**
 * Project controller.
 */
class ProjectController extends Controller
{

    /**
     * Lists all Project entities.
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();

        $entities   = $em->getRepository('HarprojectAppBundle:Project')->findAll();

        return $this->render('HarprojectAppBundle:Management\Project:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Project entity.
     */
    public function createAction(Request $request)
    {
        $entity = new Project();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            
            $user           = $this->get('security.context')->getToken()->getUser();
            //Get the manager Group or create it if inexiste
            $group_manager  = $em->getRepository("HarprojectAppBundle:Group")->findOneBy(array("is_locked" => true));
            if(!$group_manager){
                $this->container->get("harproject_app.group")->initLockedGroup();
                $group_manager  = $em->getRepository("HarprojectAppBundle:Group")->findOneBy(array("is_locked" => true));
            }
            $this->container->get("harproject_app.user")->addMember($user, $entity, $group_manager);
                    
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_management_project_show', array('id' => $entity->getId())));
        }

        return $this->render('HarprojectAppBundle:Management\Project:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Project entity.
     *
     * @param Project $entity The entity
     * 
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Project $entity)
    {
        $form = $this->createForm(new ProjectType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_management_project_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Project entity.
     */
    public function newAction()
    {
        $entity = new Project();
        $form   = $this->createCreateForm($entity);

        return $this->render('HarprojectAppBundle:Management\Project:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Project entity.
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HarprojectAppBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        return $this->render('HarprojectAppBundle:Management\Project:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Project entity.
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HarprojectAppBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('HarprojectAppBundle:Management\Project:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    /**
    * Creates a form to edit a Project entity.
    *
    * @param Project $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Project $entity)
    {
        $form = $this->createForm(new ProjectType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_management_project_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Project entity.
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HarprojectAppBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_management_project_show', array('id' => $entity->getId())));
        }

        return $this->render('HarprojectAppBundle:Management\Project:edit.html.twig', array(
            'entity'        => $entity,
            'form'          => $editForm->createView()
        ));
    }
    /**
     * Deletes a Project entity.
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('HarprojectAppBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('harproject_app_management_project'));
    }
}
