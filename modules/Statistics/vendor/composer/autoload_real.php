<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita4ef0afa76a9218737f9b5bc7c085618
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

        spl_autoload_register(array('ComposerAutoloaderInita4ef0afa76a9218737f9b5bc7c085618', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita4ef0afa76a9218737f9b5bc7c085618', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInita4ef0afa76a9218737f9b5bc7c085618::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
