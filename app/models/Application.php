<?php

class Application extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idApp;

    /**
     *
     * @var string
     */
    public $nomApp;

    /**
     *
     * @var string
     */
    public $descriptionApp;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("remediation");
        $this->setSource("application");
        $this->hasMany('idApp', 'vulnerabilite\Contenir', 'idApp', ['alias' => 'Contenir']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Application[]|Application|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Application|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null): \Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
