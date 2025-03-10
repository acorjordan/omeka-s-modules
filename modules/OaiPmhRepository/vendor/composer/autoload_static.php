<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit964a0fdaa3ef915638fa856319b2c385
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'OaiPmhRepository\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'OaiPmhRepository\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit964a0fdaa3ef915638fa856319b2c385::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit964a0fdaa3ef915638fa856319b2c385::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit964a0fdaa3ef915638fa856319b2c385::$classMap;

        }, null, ClassLoader::class);
    }
}
