<?php
namespace siesta\domain;

/**
 * Class Singleton
 * @package siesta\domain
 */
abstract class Singleton
{
    private static $_instance;

    private function __construct()
    {
    }

    /**
     * @return Singleton
     */
    public static function get()
    {
        if (empty(self::$_instance)) {
            $className = static::class;
            self::$_instance = new $className;
        }

        return self::$_instance;
    }
}