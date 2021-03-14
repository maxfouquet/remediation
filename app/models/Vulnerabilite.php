<?php

class Vulnerabilite extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idVuln;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var integer
     */
    public $severite;

    /**
     *
     * @var string
     */
    public $etat;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("heroku_16499beb91f934b");
        $this->setSource("vulnerabilite");
        $this->hasManyToMany('idVuln', 'Contenir', 'idVuln', 'idApp', 'Application', 'idApp');
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Vulnerabilite[]|Vulnerabilite|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = NULL): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Vulnerabilite|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = NULL): \Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
