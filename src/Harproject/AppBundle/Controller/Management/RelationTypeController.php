<?php

namespace Harproject\AppBundle\Controller\Management;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Harproject\AppBundle\Entity\RelationType;
use Harproject\AppBundle\Form\RelationTypeType;

/**
 * RelationType controller.
 */
class RelationTypeController extends Controller
{

    /**
     * Lists all RelationType entities.
     *
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();

        $entities   = $em->getRepository('HarprojectAppBundle:RelationType')->findAll();

        return $this->render('HarprojectAppBundle:Management\RelationType:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new RelationType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new RelationType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_management_relation_type_show', array('id' => $entity->getId())));
        }

        return $this->render('HarprojectAppBundle:Management\RelationType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a RelationType entity.
     *
     * @param RelationType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(RelationType $entity)
    {
        $form = $this->createForm(new RelationTypeType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_management_relation_type_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new RelationType entity.
     *
     */
    public function newAction()
    {
        $entity = new RelationType();
        $form   = $this->createCreateForm($entity);

        return $this->render('HarprojectAppBundle:Management\RelationType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RelationType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HarprojectAppBundle:RelationType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RelationType entity.');
        }

        return $this->render('HarprojectAppBundle:Management\RelationType:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing RelationType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HarprojectAppBundle:RelationType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RelationType entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('HarprojectAppBundle:Management\RelationType:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    /**
    * Creates a form to edit a RelationType entity.
    *
    * @param RelationType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(RelationType $entity)
    {
        $form = $this->createForm(new RelationTypeType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_management_relation_type_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing RelationType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HarprojectAppBundle:RelationType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RelationType entity.');
        }
        
        $entity->setUpdatedAt(new \DateTime());
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_management_relation_type_edit', array('id' => $id)));
        }

        return $this->render('HarprojectAppBundle:Management\RelationType:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }
    /**
     * Deletes a RelationType entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('HarprojectAppBundle:RelationType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RelationType entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('harproject_app_management_relation_type'));
    }
}
