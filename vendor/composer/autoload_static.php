<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6a773683e24d51becf5543a75654982f
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TinyGears\\' => 10,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TinyGears\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6a773683e24d51becf5543a75654982f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6a773683e24d51becf5543a75654982f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6a773683e24d51becf5543a75654982f::$classMap;

        }, null, ClassLoader::class);
    }
}