<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5adf77c814737a85f84ac6eb579e55e1
{
    public static $files = array (
        '8e6da87b304e0ed6a80934464eef5056' => __DIR__ . '/../..' . '/activation-deactivation.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WCPress\\WCP\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WCPress\\WCP\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5adf77c814737a85f84ac6eb579e55e1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5adf77c814737a85f84ac6eb579e55e1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5adf77c814737a85f84ac6eb579e55e1::$classMap;

        }, null, ClassLoader::class);
    }
}
