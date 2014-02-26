<?php
namespace MarijnKoesen\DebugBundle\Library;

// TODO: make this class nice 
class RequestId
{
    private static $id;

    public static function registerId()
    {
        apache_note('UniqueRequestId', self::getId());
    }

    public static function getId()
    {
        if (!self::$id) {
            self::$id = self::createId();
        }

        return self::$id;
    }

    protected static function createId()
    {
        if (isset($_SERVER['HTTP_REQUESTID'])) {
            return $_SERVER['HTTP_REQUESTID'];
        }

        return uniqid();
    }
}
