<?php

namespace app\Logger;

class Logger
{
    private static $handler = null;
    public function __construct()
    {

    }

    public function addHandler($handler)    {
        self::$handler = $handler;
    }

    public function handler()
    {
        return self::$handler;
    }


    public function log($level, $message)    {

        $handler = self::$handler;

        $handler->log($level, $message);

    }
    public function error($message)    {

        $handler = self::$handler;

        $handler->log(LogLevel::LEVEL_ERROR, $message);

    }
    public function info($message)    {

        $handler = self::$handler;

        $handler->log(LogLevel::LEVEL_INFO, $message);

    }
    public function debug($message)    {

        $handler = self::$handler;

        $handler->log(LogLevel::LEVEL_DEBUG, $message);

    }
    public function notice($message)    {

        $handler = self::$handler;

        $handler->log(LogLevel::LEVEL_NOTICE, $message);

    }
}