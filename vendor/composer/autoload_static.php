<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7a972844f31b64390602757c3d22cc37
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Moment\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Moment\\' => 
        array (
            0 => __DIR__ . '/..' . '/fightbulc/moment/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7a972844f31b64390602757c3d22cc37::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7a972844f31b64390602757c3d22cc37::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
