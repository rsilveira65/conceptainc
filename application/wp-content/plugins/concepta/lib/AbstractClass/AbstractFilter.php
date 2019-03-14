<?php

namespace Concepta\Core\AbstractClass;

/**
 * Class AbstractFilter
 *
 * @package Concepta\Core\AbstractClass
 */
abstract class AbstractFilter
{

    /**
     * @var string|array
     */
    protected $tag;

    /**
     * @var int
     */
    protected $priority = 10;

    /**
     * @var int
     */
    protected $acceptedArgs = 1;

    /**
     * @return array
     */
    public function getTag()
    {
        return $this->tag;
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

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @param int $acceptedArgs
     */
    public function setAcceptedArgs($acceptedArgs)
    {
        $this->acceptedArgs = $acceptedArgs;
    }

}
