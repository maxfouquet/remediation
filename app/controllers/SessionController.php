<?php
declare(strict_types=1);

class SessionController extends ControllerBase
{

    public function indexAction()
    {
        
    }

    private function _registerSession($utilisateur)
    {
        $this->session->set(
            'auth',
            [
                'id'   => $utilisateur->idUtilisateur,
                'nom' => $utilisateur->nom . ' ' . $utilisateur->prenom,
                'role' => $utilisateur->role
            ]
        );
    }

    public function startAction()
    {
        if ($this->request->isPost()) {
            $identifiant    = $this->request->getPost('identifiant');
            $password = $this->request->getPost('password');

            $utilisateur = Utilisateur::findFirst(
                [
                    "identifiant = :identifiant: AND motdepasse = :password:",
                    'bind' => [
                        'identifiant'    => $identifiant,
                        'password' => sha1($password),
                    ]
                ]
            );
            if ($utilisateur) {
        
                $this->_registerSession($utilisateur);

                $this->flash->success(
                    'Bienvenue ' . $utilisateur->nom . ' ' . $utilisateur->prenom
                );

                return $this->dispatcher->forward(
                    [
                        'controller' => 'index',
                        'action'     => 'index',
                    ]
                );
                
            }
            $this->flash->error(
                'Mauvais identifiant/mot de passe'
            );
        }

        return $this->dispatcher->forward(
            [
                'controller' => 'session',
                'action'     => 'index',
            ]
        );
    }

    public function endAction()
    {
        $this->session->remove('auth'); 

        $this->flash->success(
            "Vous n'êtes plus connecté"
        );

        return $this->dispatcher->forward(
            [
                'controller' => 'index',
                'action'     => 'index',
            ]
        );
    }

}

