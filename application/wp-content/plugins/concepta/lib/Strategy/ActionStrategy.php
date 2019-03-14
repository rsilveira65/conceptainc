<?php

namespace Concepta\Core\Strategy;

use Concepta\Core\AbstractClass\AbstractAction;

/**
 * Class ActionStrategy
 *
 * @package Concepta\Core\Strategy
 */
class ActionStrategy
{

    /**
     * @param $files
     * @throws \Exception
     */
    public function run($files)
    {
        foreach ($files as $file) {
            $classInstance = new $file();

            if (!$classInstance instanceof AbstractAction) {
                throw new \Exception(sprintf('The action class must be an instance of AbstractAction. [%s]', get_class($classInstance)));
            }

            if ($classInstance->getType() == 'admin' and !is_admin()) {
                continue;
            }

            if (is_array($classInstance->getAction())) {
                foreach ($classInstance->getAction() as $action) {
                    $this->addAction($action, $classInstance);
                }

                continue;
            }

            if (!strlen($classInstance->getAction())) {
                continue;
            }

            $this->addAction($classInstance->getAction(), $classInstance);
        }
    }

    private function addAction($action, $classInstance)
    {
        add_action(
            $action,
            [$classInstance, 'run'],
            $classInstance->getPriority(),
            $classInstance->getAcceptedArgs()
        );
    }

}
