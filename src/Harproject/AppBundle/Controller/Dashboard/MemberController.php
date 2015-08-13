<?php

namespace Harproject\AppBundle\Controller\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Harproject\AppBundle\Request\HarprojectRole;

use Symfony\Component\HttpFoundation\Request;
use Harproject\AppBundle\Entity\Member;
use Harproject\AppBundle\Form\MemberType;

/**
 * Member controller.
 */
class MemberController extends Controller
{

    /**
     * @HarprojectRole(role="MEMBER_VIEW")
     */
    public function indexAction(){
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        $entities   = $em->getRepository('HarprojectAppBundle:Member')->findBy(array(
            "project" => $em->getRepository('HarprojectAppBundle:Project')->find($project_id)
        ));
        
        return $this->render('HarprojectAppBundle:Dashboard\Member:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new Member entity.
     * @HarprojectRole(role="MEMBER_ADD")
     */
    public function createAction(Request $request)
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        $project    = $em->getRepository('HarprojectAppBundle:Project')->find($project_id);
        
        $entity = new Member();
        $entity->setProject($project);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_dashboard_member_show', array('id' => $entity->getId())));
        }

        return $this->render('HarprojectAppBundle:Dashboard\Member:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Member entity.
     *
     * @param Member $entity The entity
     * 
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Member $entity)
    {
        $form = $this->createForm(new MemberType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_dashboard_member_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Member entity.
     * @HarprojectRole(role="MEMBER_ADD")
     */
    public function newAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        
        $entity = new Member();
        $project    = $em->getRepository('HarprojectAppBundle:Project')->find($project_id);
        
        $entity->setProject($project);
        $form       = $this->createCreateForm($entity);

        return $this->render('HarprojectAppBundle:Dashboard\Member:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Member entity.
     * @HarprojectRole(role="MEMBER_VIEW")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');
        
        $entity = $em->getRepository('HarprojectAppBundle:Member')->findOneBy(array(
            "project"   => $em->getRepository('HarprojectAppBundle:Project')->find($project_id),
            "id"        => $id
        ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }

        return $this->render('HarprojectAppBundle:Dashboard\Member:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Member entity.
     * @HarprojectRole(role="MEMBER_EDIT")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $project_id = $this->get('session')->get('project_id');
        
        $entity     = $em->getRepository('HarprojectAppBundle:Member')->findOneBy(array(
            "project"   => $em->getRepository('HarprojectAppBundle:Project')->find($project_id),
            "id"        => $id
        ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }

        $editForm = $this->createEditForm($entity);
        
        return $this->render('HarprojectAppBundle:Dashboard\Member:edit.html.twig', array(
            'entity'        => $entity,
            'form'          => $editForm->createView()
        ));
    }

    /**
    * Creates a form to edit a Member entity.
    *
    * @param Member $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    *
    */
    private function createEditForm(Member $entity)
    {
        $form = $this->createForm(new MemberType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_dashboard_member_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Member entity.
     * @HarprojectRole(role="MEMBER_EDIT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $project_id = $this->get('session')->get('project_id');
        
        $entity     = $em->getRepository('HarprojectAppBundle:Member')->findOneBy(array(
            "project"   => $em->getRepository('HarprojectAppBundle:Project')->find($project_id),
            "id"        => $id
        ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }

        $entity->setUpdatedAt(new \DateTime());
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_dashboard_member_edit', array('id' => $id)));
        }

        return $this->render('HarprojectAppBundle:Dashboard\Member:edit.html.twig', array(
            'entity'        => $entity,
            'form'          => $editForm->createView()
        ));
    }
    /**
     * Deletes a Member entity.
     * @HarprojectRole(role="MEMBER_DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $em         = $this->getDoctrine()->getManager();
        $project_id = $this->get('session')->get('project_id');

        $entity     = $em->getRepository('HarprojectAppBundle:Member')->findOneBy(array(
            "project"   => $em->getRepository('HarprojectAppBundle:Project')->find($project_id),
            "id"        => $id
        ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }
        
        $this->get('harproject_app.user')->deleteMember($entity);
        return $this->redirect($this->generateUrl('harproject_app_dashboard_member'));
    }
}
