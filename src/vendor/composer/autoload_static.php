<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit511f86424e28a2defeb03c9b3f6fcee1
{
    public static $files = array (
        'decc78cc4436b1292c6c0d151b19445c' => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'phpseclib\\' => 10,
        ),
        'I' => 
        array (
            'IMSGlobal\\LTI\\' => 14,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'phpseclib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib',
        ),
        'IMSGlobal\\LTI\\' => 
        array (
            0 => __DIR__ . '/..' . '/imsglobal/lti-1p3-tool/src/lti',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/fproject/php-jwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit511f86424e28a2defeb03c9b3f6fcee1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit511f86424e28a2defeb03c9b3f6fcee1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
