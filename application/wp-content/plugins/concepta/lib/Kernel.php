<?php

namespace Concepta\Core;

class Kernel
{
    protected $neededClassTypes = [
        '.*(Action).php$',
        '.*(Filter).php$',
        '.*(Shortcode).php$',
        '.*(VisualComposer).php$'
    ];

    protected $excludedNamespaces = [
        'src\/Core'
    ];

    /**
     * Kernel constructor.
     */
    public function __construct()
    {
        $mappedClassesByStrategy = $this->mapFilesByClassType();
        $strategyNamespace = '\Concepta\Core\Strategy\%sStrategy';

        foreach ($mappedClassesByStrategy as $strategyName => $files) {
            $strategyClass    = sprintf($strategyNamespace, $strategyName);
            $strategyInstance = new $strategyClass();

            $strategyInstance->run($files);
        }
    }

    /**
     * Method to read the source directory and returns all files
     *
     * @return array
     */
    public function mapFilesByClassType()
    {
        $classesPath = sprintf('%swp-content/plugins/%s/src/', ABSPATH, preg_replace('/^(.*)\/.*/', '$1', CONCEPTA_DOMAIN));

        $iterator = new \RecursiveDirectoryIterator($classesPath);

        $neededClassTypes = implode('|', $this->neededClassTypes);
        $excludedNamespaces = implode('|', $this->excludedNamespaces);

        $files = [];
        foreach (new \RecursiveIteratorIterator($iterator) as $fileName => $current) {
            preg_match(sprintf('/%s/', $neededClassTypes), $fileName, $match);

            if (!count($match)) {
                continue;
            }

            preg_match(sprintf('/%s/', $excludedNamespaces), $fileName, $excludeMatch);

            if (count($excludeMatch)) {
                continue;
            }

            $classType = end($match);

            if (!isset($files[$classType])) {
                $files[$classType] = [];
            }

            $fileName = substr($fileName, strpos($fileName, '/src/') + 5);
            $fileName = substr($fileName, 0, strpos($fileName, '.php'));
            $fileName = str_replace('/', '\\', $fileName);
            $fileName = 'Concepta\\' . $fileName;

            $files[$classType][] = $fileName;
        }

        return $files;
    }

}
