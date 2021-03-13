<?php
declare(strict_types=1);

class VulnerabiliteController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->severites = array("basse", "moyenne", "haute");
        $this->view->classes = array("info", "warning", "danger");
        $this->view->etats = array("A corriger", "Corrigé");
        $field = $this->request->getQuery('field', '', 'description');
        $order = $this->request->getQuery('order', '', 'ASC');
        $this->view->vulnerabilites = Vulnerabilite::find([
            "order" => $field." ".$order
        ]);

        $auth = $this->session->get('auth');
        if($auth){
            $role = $auth['role']->libelle;
        } else {
            $role = "visiteur";
        }
        $this->view->role = $role;
    }

    public function viewAction($id)
    {
        $this->view->severites = array("basse", "moyenne", "haute");
        $this->view->etats = array("A corriger", "Corrigé");
        $this->view->vulnerabilite = Vulnerabilite::findFirst($id);
    }

    public function correctAction($id)
    {
        $vulnerabilite = Vulnerabilite::findFirst($id);
        $vulnerabilite->etat = 1;
        $vulnerabilite->save();

        return $this->dispatcher->forward(
            [
                'controller' => 'vulnerabilite',
                'action'     => 'index',
            ]
        );
    }

    public function addAction($id = null)
    {
        $this->view->applications = Application::find();

        if ($this->request->isPost()) {
            $applications = array();
            $apps = $this->request->getPost("applications");

            foreach($apps as $app){
                $application = Application::findFirst($app);
                $applications[] = $application;
            }

            $vulnerabilite = new Vulnerabilite();
            
            $vulnerabilite->description  = $this->request->getPost("description");
            $vulnerabilite->severite     = $this->request->getPost("severite");
            $vulnerabilite->application  = $applications;
            $vulnerabilite->etat         = 0;

            $vulnerabilite->save();

            $this->flash->success(
                'La vulnérabilité a été ajoutée.'
            );

            return $this->dispatcher->forward(
                [
                    'controller' => 'vulnerabilite',
                    'action'     => 'index',
                ]
            );
        }
    }

    public function updateAction($id){
        $this->view->severites = array("basse", "moyenne", "haute");
        $vulnerabilite = Vulnerabilite::findFirst($id);

        $this->view->vulnerabilite = $vulnerabilite;
        $this->view->applications = Application::find();

        if ($this->request->isPost()) {
            $applications = array();
            $apps = $this->request->getPost("applications");

            foreach($apps as $app){
                $application = Application::findFirst($app);
                $applications[] = $application;
            }

            $vulnerabilite->description  = $this->request->getPost("description");
            $vulnerabilite->severite     = $this->request->getPost("severite");
            $vulnerabilite->application  = $applications;
            $vulnerabilite->etat         = 0;

            $vulnerabilite->save();

            $this->flash->success(
                'La vulnérabilité a été mise à jour.'
            );

            return $this->dispatcher->forward(
                [
                    'controller' => 'vulnerabilite',
                    'action'     => 'index',
                ]
            );
        }
    }

    public function deleteAction($id)
    {
        $vulnerabilite = Vulnerabilite::findFirst($id);
        $vulnerabilite->delete();

        $this->flash->success(
            'La vulnérabilité a été supprimée.'
        );

        return $this->dispatcher->forward(
            [
                'controller' => 'vulnerabilite',
                'action'     => 'index',
            ]
        );
    }

}

