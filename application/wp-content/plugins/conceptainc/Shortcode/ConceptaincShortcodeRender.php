<?php

class ConceptaincShortcodeRender
{
    static private $initialized = false;

    static public function init()
    {
        if (self::$initialized === false) {
            self::initHooks();
        }
    }

    static private function initHooks()
    {
        self::requireClasses();
    }

    /**
     * @param $name
     * @param $args
     * @return string
     */
    static private function render($name, $args)
    {
        foreach ($args as $key => $val) {
            $$key = $val;
        }

        ob_start();

        include sprintf("%sShortcode/views/%s.phtml", CONCEPTAINC__PLUGIN_DIR, $name);

        $renderedView = ob_get_clean();

        return $renderedView;
    }

    /**
     * @param $name
     * @param array $args
     * @return string
     */
    static public function view($name, array $args = [])
    {
        return self::render($name, $args);
    }

    static public function requireClasses()
    {

    }

}
