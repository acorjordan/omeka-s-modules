<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita4ef0afa76a9218737f9b5bc7c085618
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Statistics\\' => 11,
        ),
        'O' => 
        array (
            'OpenSpout\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Statistics\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'OpenSpout\\' => 
        array (
            0 => __DIR__ . '/..' . '/openspout/openspout/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita4ef0afa76a9218737f9b5bc7c085618::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita4ef0afa76a9218737f9b5bc7c085618::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita4ef0afa76a9218737f9b5bc7c085618::$classMap;

        }, null, ClassLoader::class);
    }
}
