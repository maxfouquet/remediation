<?php
declare(strict_types=1);

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Component;
use Phalcon\Acl\Role;
use Phalcon\Acl\Enum;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Injectable
{
    /**
     * This action is executed before execute any action in the application
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return bool
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $auth = $this->session->get('auth');
        
        if($auth){
            $role = $auth['role']->libelle;
        } else {
            $role = 'visiteur';
        }

        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        $acl = $this->getAcl();

        if (!$acl->isComponent($controller)) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action'     => 'show404',
            ]);

            return false;
        }

        $allowed = $acl->isAllowed($role, $controller, $action);
        if (!$allowed) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action'     => 'show401',
            ]);

            return false;
        }

        return true;
    }

    /**
     * Returns an existing or new access control list
     *
     * @returns AclList
     */
    protected function getAcl(): AclList
    {
        if (isset($this->persistent->acl)) {
            return $this->persistent->acl;
        }

        $acl = new AclList();
        $acl->setDefaultAction(Enum::DENY);

        // Register roles
        $roles = [
            'visiteur' => new Role(
                'visiteur',
                'Les visiteurs sont les utilisateurs non connectés.'
            ), 
            'utilisateur' => new Role(
                'utilisateur',
                'Les membres connectés peuvent consulter les vulnérabilités.'
            ),
            'responsable' => new Role(
                'responsable',
                'Les responsables sécurité peuvent corriger une vulnérabilité.'
            ),
            'administrateur' => new Role(
                'administrateur',
                'Les administrateurs peuvent ajouter, modifier ou supprimer des vulnérabilités.'
            )
        ];

        foreach ($roles as $role) {
            $acl->addRole($role);
        }

        //User area resources
        $userResources = [
            'vulnerabilite' => ['index', 'view']
        ];

        foreach ($userResources as $resource => $actions) {
            $acl->addComponent(new Component($resource), $actions);
        }

        //Manager area resources
        $managerResources = [
            'vulnerabilite' => ['correct']
        ];

        foreach ($managerResources as $resource => $actions) {
            $acl->addComponent(new Component($resource), $actions);
        }

        //Administrator area ressources
        $administratorResources = [
            'vulnerabilite' => ['delete', 'add', 'update']
        ];

        foreach ($administratorResources as $resource => $actions) {
            $acl->addComponent(new Component($resource), $actions);
        }


        //Public area resources
        $publicResources = [
            'index' => ['index'],
            'errors' => ['show401', 'show404'],
            'session' => ['index', 'start', 'end']
        ];

        foreach ($publicResources as $resource => $actions) {
            $acl->addComponent(new Component($resource), $actions);
        }

        //Grant access to public areas to all
        foreach ($roles as $role) {
            foreach ($publicResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow($role->getName(), $resource, $action);
                }
            }
        }

        //Grant access to administrator area to administrators 
        foreach ($administratorResources as $resource => $actions) {
            foreach ($actions as $action) {
                $acl->allow('administrateur', $resource, $action);
            }
        }

        //Grant access to user areas to user
        foreach ($userResources as $resource => $actions) {
            foreach ($actions as $action) {
                $acl->allow('utilisateur', $resource, $action);
                $acl->allow('responsable', $resource, $action);
                $acl->allow('administrateur', $resource, $action);
            }
        }

        //Grant access to manager area to managers
        foreach ($managerResources as $resource => $actions) {
            foreach ($actions as $action) {
                $acl->allow('responsable', $resource, $action);
            }
        }

        //The acl is stored in session, APC would be useful here too
        $this->persistent->acl = $acl;

        return $acl;
    }
}