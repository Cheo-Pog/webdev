<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7b439c4d754eb5c1fd54863ca2fb919c
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Views\\' => 10,
            'App\\Services\\' => 13,
            'App\\Repositories\\' => 17,
            'App\\Modules\\' => 12,
            'App\\Controllers\\' => 16,
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Views\\' => 
        array (
            0 => __DIR__ . '/../..' . '/views',
        ),
        'App\\Services\\' => 
        array (
            0 => __DIR__ . '/../..' . '/services',
        ),
        'App\\Repositories\\' => 
        array (
            0 => __DIR__ . '/../..' . '/repositories',
        ),
        'App\\Modules\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules',
        ),
        'App\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7b439c4d754eb5c1fd54863ca2fb919c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7b439c4d754eb5c1fd54863ca2fb919c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7b439c4d754eb5c1fd54863ca2fb919c::$classMap;

        }, null, ClassLoader::class);
    }
}
