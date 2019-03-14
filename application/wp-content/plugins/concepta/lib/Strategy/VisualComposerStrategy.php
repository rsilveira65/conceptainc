<?php

namespace Concepta\Core\Strategy;
use Concepta\Core\AbstractClass\AbstractVisualComposer;

/**
 * Class VisualComposerStrategy
 *
 * @package Concepta\Core\Strategy
 */
class VisualComposerStrategy
{

    /**
     * @param $files
     * @throws \Exception
     */
    public function run($files)
    {
        global $pagenow;

        if (!in_array($pagenow, ['post.php', 'post-new.php', 'admin-ajax.php'])) {
            return;
        }

        foreach ($files as $file) {
            $classInstance = new $file();

            if (!$classInstance instanceof AbstractVisualComposer) {
                throw new \Exception(sprintf('The action class must be an instance of AbstractVisualComposer. [%s]', get_class($classInstance)));
            }

            add_action(
                'vc_before_init',
                function () use ($classInstance) {
                    if (!function_exists('vc_map')) {
                        return;
                    }

                    $map = $classInstance->map();
                    if (!$map) {
                        return;
                    }

                    vc_map($map);
                }
            );
        }
    }

}
