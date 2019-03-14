<?php

namespace Concepta\Core\Strategy;

use Concepta\Core\AbstractClass\AbstractFilter;

/**
 * Class FilterStrategy
 *
 * @package Concepta\Core\Strategy
 */
class FilterStrategy
{

    /**
     * @param $files
     * @throws \Exception
     */
    public function run($files)
    {
        foreach ($files as $file) {
            $classInstance = new $file();

            if (!$classInstance instanceof AbstractFilter) {
                throw new \Exception(sprintf('The action class must be an instance of AbstractFilter. [%s]', get_class($classInstance)));
            }

            if (!method_exists($classInstance, 'run')) {
                continue;
            }

            if (!is_array($classInstance->getTag())) {
                $classInstance->setTag([$classInstance->getTag()]);
            }

            foreach ($classInstance->getTag() as $tag) {
                add_filter(
                    $tag,
                    [$classInstance, 'run'],
                    $classInstance->getPriority(),
                    $classInstance->getAcceptedArgs()
                );
            }
        }
    }

}
