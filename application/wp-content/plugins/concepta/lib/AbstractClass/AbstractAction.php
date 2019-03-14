<?php

namespace Concepta\Core\AbstractClass;

/**
 * Class AbstractAction
 *
 * @package Concepta\Core\AbstractClass
 */
abstract class AbstractAction
{

    /**
     * @var string|array
     */
    protected $action;

    /**
     * @var string
     */
    protected $type = 'normal';

    /**
     * @var int
     */
    protected $priority = 10;

    /**
     * @var int
     */
    protected $acceptedArgs = 1;

    /**
     * Method that will be executed when the action was called.
     */
    abstract public function run();

    /**
     * @return string|array
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return int
     */
    public function getAcceptedArgs()
    {
        return $this->acceptedArgs;
    }

}
