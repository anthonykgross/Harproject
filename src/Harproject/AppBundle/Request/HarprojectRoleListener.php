<?php

namespace Harproject\AppBundle\Request;


use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Harproject\AppBundle\Exception\Exception;
use Harproject\AppBundle\Exception\Http\NotFoundException;
use Harproject\AppBundle\Exception\Http\UnauthorizedHttpException;
use Harproject\AppBundle\Exception\Http\AccessDeniedException;

/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
class HarprojectRoleListener
{
    /**
     * @var Reader An Reader instance
     */
    protected $reader;
    
    protected $container;

    /**
     * Constructor.
     *
     * @param Reader $reader An Reader instance
     */
    public function __construct(Reader $reader, $container)
    {
        $this->reader       = $reader;
        $this->container    = $container;
    }

    /**
     * @param FilterControllerEvent $event A FilterControllerEvent instance
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        if (!is_array($controller = $event->getController())) {
            return;
        }

        // Annotations from class
        $class = new \ReflectionClass($controller[0]);

        // Manage JMSSecurityExtraBundle proxy class
        if (false !== $className = $this->getRealClass($class->getName())) {
            $class = new \ReflectionClass($className);
        }

        if ($class->isAbstract()) {
            throw new \InvalidArgumentException(sprintf('Annotations from class "%s" cannot be read as it is abstract.', $class));
        }

        if ($event->getRequestType() == HttpKernelInterface::MASTER_REQUEST) {
            // Annotations from method
            $method = $class->getMethod($controller[1]);
            $this->checkRoleFromAnnotations($this->reader->getMethodAnnotations($method));
        }
    }

    /**
     * @param Array $annotations Array of Role annotations
     */
    private function checkRoleFromAnnotations(array $annotations)
    {
        // requirements (@Role)
        foreach ($annotations as $annotation) {
            if ($annotation instanceof HarprojectRole) {

                $member = $this->getMember();
                
                if(is_null($member)){
                    throw new UnauthorizedHttpException('', "This user isn't a member of the Project");
                }
                
                if(!$this->container->get('harproject_app.user')->hasRole($member, $annotation->getRole())){
                    throw new AccessDeniedException("Acces denied for this group");
                }
            }
        }
    }

    private function getRealClass($className)
    {
        if (false === $pos = strrpos($className, '\\__CG__\\')) {
            return false;
        }

        return substr($className, $pos + 8);
    }
    
    private function getMember(){
        $request                    = $this->container->get('request');
        $em                         = $this->container->get('doctrine')->getManager();
        $service_harproject_user    = $this->container->get('harproject_app.user');
        $user                       = $this->container->get('security.context')->getToken()->getUser();
        
        /**
         * We search the project id in request or in Session
         */
        $project_id = $request->get('project_id', NULL);
        if(is_null($project_id)){
            $project_id = $request->getSession()->get('project_id', NULL);
        }
        if(is_null($project_id)){
            throw new NotFoundException('Project not found');
        }
        $project = $em->getRepository("HarprojectAppBundle:Project")->find($project_id);
        if(!$project){
            throw new NotFoundException('Project not found');
        }
        
        /**
         * Role are defined only for the registered user
         */
        if($user == "anon."){
            throw new UnauthorizedHttpException("",'User not found');
        }
        return $service_harproject_user->getMember($user, $project);
    }
}
