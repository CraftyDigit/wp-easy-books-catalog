<?php

namespace Core;

/**
 * EBC custom PSR-4 autoloader class
 */
class EBCAutoloader
{
    /**
     * Register custom autoloader function
     *
     * @return void
     */
    public static function register(): void
    {
        spl_autoload_register(
            function ($class) {
                $rootDirectory = dirname(__DIR__) . '/';

                $file = $rootDirectory . str_replace('\\', '/', $class) . '.php';

                if (file_exists($file)) {
                    require $file;
                }
            }
        );
    }
}