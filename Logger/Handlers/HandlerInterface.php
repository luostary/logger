<?php

namespace app\Logger\Handlers;

interface HandlerInterface
{
    public function log(string $level, string $message);
    public function error(string $message);
    public function info(string $message);
    public function debug(string $message);
    public function notice(string $message);
    public function setIsEnabled(bool $is_enabled);
}