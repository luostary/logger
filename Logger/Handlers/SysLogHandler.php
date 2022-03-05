<?php

namespace app\Logger\Handlers;

use app\Logger\Formatters\LineFormatter;
use app\Logger\LogLevel;

class SysLogHandler implements HandlerInterface
{
    public $is_enabled = false;
    public $levels = [
        LogLevel::LEVEL_ERROR
    ];

    public function __construct($params)
    {
        $this->is_enabled = $params['is_enabled'];
        $this->levels = $params['levels'];
    }

    public function log(string $level, string $message)    {

        if (!$this->is_enabled) {
            return false;
        }
        switch ($level) {
            case LogLevel::LEVEL_ERROR:
                $levelCode = LogLevel::LEVEL_CODE_ERROR;
                break;
            case LogLevel::LEVEL_DEBUG:
                $levelCode = LogLevel::LEVEL_CODE_DEBUG;
                break;
            case LogLevel::LEVEL_NOTICE:
                $levelCode = LogLevel::LEVEL_CODE_NOTICE;
                break;
            default:
                $levelCode = LogLevel::LEVEL_CODE_INFO;
                break;
        }

        $formatter = new LineFormatter();

        /** Сохранение в БД */
//        SysLog::insert([
//            'date' => date($formatter->date),
//            'level_code' => $levelCode,
//            'level' => $level,
//            'message' => $message,
//        ]);
    }
    public function error(string $message)    {
        $this->log(LogLevel::LEVEL_ERROR, $message);
    }
    public function info(string $message)    {
        $this->log(LogLevel::LEVEL_INFO, $message);
    }
    public function debug(string $message)    {
        $this->log(LogLevel::LEVEL_DEBUG, $message);
    }
    public function notice(string $message)    {
        $this->log(LogLevel::LEVEL_NOTICE, $message);
    }

    public function setIsEnabled(bool $is_enable)    {
        $this->is_enabled = $is_enable;
    }
}