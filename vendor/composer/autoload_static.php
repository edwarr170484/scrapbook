<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf2e22604cefd341bbf94b36870421ac7
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Scrapbook\\Core\\' => 15,
            'Scrapbook\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Scrapbook\\Core\\' => 
        array (
            0 => __DIR__ . '/..' . '/scrapbook',
        ),
        'Scrapbook\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitf2e22604cefd341bbf94b36870421ac7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf2e22604cefd341bbf94b36870421ac7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf2e22604cefd341bbf94b36870421ac7::$classMap;

        }, null, ClassLoader::class);
    }
}
