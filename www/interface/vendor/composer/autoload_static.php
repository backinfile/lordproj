<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2ec4c5ded09bd7c0b34d7da539721e1
{
    public static $prefixLengthsPsr4 = array (
        'Q' => 
        array (
            'Qcloud\\Sms\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Qcloud\\Sms\\' => 
        array (
            0 => __DIR__ . '/..' . '/qcloudsms/qcloudsms_php/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc2ec4c5ded09bd7c0b34d7da539721e1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc2ec4c5ded09bd7c0b34d7da539721e1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
