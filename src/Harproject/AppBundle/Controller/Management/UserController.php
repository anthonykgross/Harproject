<?php

namespace Harproject\AppBundle\Controller\Management;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lsw\SecureControllerBundle\Annotation\Secure;

use Harproject\AppBundle\Entity\User;
use Harproject\AppBundle\Form\UserType;

/**
 * User controller.
 * @Secure(roles="ROLE_MANAGER")
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HarprojectAppBundle:User')->findAll();

        return $this->render('HarprojectAppBundle:Management\User:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a User entity.
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HarprojectAppBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        return $this->render('HarprojectAppBundle:Management\User:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Deletes a User entity.
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('HarprojectAppBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $em->remove($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('harproject_app_management_user'));
    }
}
