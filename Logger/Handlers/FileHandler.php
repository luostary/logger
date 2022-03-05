<?php

namespace app\Logger\Handlers;

use app\Logger\Formatters\LineFormatter;
use app\Logger\LogLevel;

class FileHandler implements HandlerInterface
{
    public $is_enabled = false;

    public $filename = NULL;
    public $formatter = '';

    public function __construct($params)
    {
        $this->is_enabled = $params['is_enabled'];
        $this->filename = $params['filename'];
        $this->formatter = $params['formatter'];
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

        $replacers = [
            '%date%' => date($formatter->date),
            '%level_code%' => $levelCode,
            '%level%' => $level,
            '%message%' => $message,
        ];

        $message = str_replace(array_keys($replacers), $replacers, $formatter->format)  . "\n";

        $append = FILE_APPEND;

        file_put_contents($this->filename, $message, $append);
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