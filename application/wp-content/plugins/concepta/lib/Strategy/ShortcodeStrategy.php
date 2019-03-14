<?php

namespace Concepta\Core\Strategy;

use Concepta\Core\AbstractClass\AbstractShortcode;

/**
 * Class ShortcodeStrategy
 *
 * @package Concepta\Core\Strategy
 */
class ShortcodeStrategy
{

    /**
     * @param $files
     * @throws \Exception
     */
    public function run($files)
    {
        foreach ($files as $file) {
            $classInstance   = new $file();

            if (!$classInstance instanceof AbstractShortcode) {
                throw new \Exception(sprintf('The action class must be an instance of AbstractShortcode. [%s]', get_class($classInstance)));
            }

            add_shortcode(
                $classInstance->getName(),
                [$classInstance, 'run']
            );
        }
    }

}
