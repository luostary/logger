<?php

namespace app\Logger\Formatters;

class LineFormatter
{
    public $format = '%date% %level_code% %level% %message%';
    public $date = 'Y-m-d H:i:s';

    public function __construct($format = '', $date = '')
    {
        if (!empty($format)) {
            $this->format = $format;
        }

        if (!empty($date)) {
            $this->date = $date;
        }
    }
}