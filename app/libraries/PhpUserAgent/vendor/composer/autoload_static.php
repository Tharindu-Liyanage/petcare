<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9c0714cc0dab1f15366fc36ef8f400c9
{
    public static $files = array (
        'da5f6548f070d3d306f90eee42dd5de6' => __DIR__ . '/..' . '/donatj/phpuseragentparser/src/UserAgentParser.php',
    );

    public static $prefixLengthsPsr4 = array (
        'd' => 
        array (
            'donatj\\UserAgent\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'donatj\\UserAgent\\' => 
        array (
            0 => __DIR__ . '/..' . '/donatj/phpuseragentparser/src/UserAgent',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9c0714cc0dab1f15366fc36ef8f400c9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9c0714cc0dab1f15366fc36ef8f400c9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9c0714cc0dab1f15366fc36ef8f400c9::$classMap;

        }, null, ClassLoader::class);
    }
}
