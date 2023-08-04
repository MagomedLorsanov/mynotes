<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita4212bb1e2892c4a25e982fa79f0b5f8
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInita4212bb1e2892c4a25e982fa79f0b5f8', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita4212bb1e2892c4a25e982fa79f0b5f8', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInita4212bb1e2892c4a25e982fa79f0b5f8::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}