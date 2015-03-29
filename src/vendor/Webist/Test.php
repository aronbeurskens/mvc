<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name test.php
 * @author Webist
 * Created at : Mar 8, 2015 5:54:47 PM
 * UTF-8
 *
 */

namespace src\vendor\Webist;

class Test
{

    private function convert($size)
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }

    public function results()
    {

        $str = "Memory usage " . $this->convert(memory_get_usage(true)) . PHP_EOL;
        $str .= "Peak memory " . $this->convert(memory_get_peak_usage(true)) . PHP_EOL;

        return $str;
    }

}