<?php

namespace Concepta\Core\AbstractClass;

/**
 * Class AbstractShortcode
 *
 * @package Concepta\Core\AbstractClass
 */
abstract class AbstractShortcode
{
    /**
     * @var string
     */
    protected $name;

    /**
     * Method that will be executed when the action was called.
     *
     * @param array $attributes
     * @param string $content
     * @return string|array
     */
    abstract public function run($attributes, $content);

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
