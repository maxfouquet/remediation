<?php

class Contenir extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idVuln;

    /**
     *
     * @var integer
     */
    public $idApp;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("remediation");
        $this->setSource("Contenir");
        $this->belongsTo('idApp', 'Application', 'idApp', ['alias' => 'Application']);
        $this->belongsTo('idVuln', 'Vulnerabilite', 'idVuln', ['alias' => 'Vulnerabilite']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contenir[]|Contenir|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contenir|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null): \Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
