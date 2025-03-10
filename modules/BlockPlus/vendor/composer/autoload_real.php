<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInite839ff917c1442f76c90f70d1bdc481a
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInite839ff917c1442f76c90f70d1bdc481a', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInite839ff917c1442f76c90f70d1bdc481a', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInite839ff917c1442f76c90f70d1bdc481a::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
