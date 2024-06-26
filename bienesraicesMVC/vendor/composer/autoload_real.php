<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInite31f710b0e55b8bc34347e036a7d7574
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInite31f710b0e55b8bc34347e036a7d7574', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInite31f710b0e55b8bc34347e036a7d7574', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInite31f710b0e55b8bc34347e036a7d7574::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
