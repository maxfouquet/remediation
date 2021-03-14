<?php

class Utilisateur extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idUtilisateur;

    /**
     *
     * @var string
     */
    public $nom;

    /**
     *
     * @var string
     */
    public $prenom;

    /**
     *
     * @var string
     */
    public $adresse;

    /**
     *
     * @var string
     */
    public $identifiant;

    /**
     *
     * @var string
     */
    public $motdepasse;

    /**
     *
     * @var integer
     */
    public $idRole;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("heroku_16499beb91f934b");
        $this->setSource("utilisateur");
        $this->belongsTo('idRole', 'Role', 'idRole', ['alias' => 'Role']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Utilisateur[]|Utilisateur|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Utilisateur|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
