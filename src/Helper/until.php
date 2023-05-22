<?php

if (! function_exists('convertTime')) {
    function convertTime(string $timeString, String $format = 'jS F Y h:i A'): string
    {
        return DateTime::createFromFormat('d/m/Y H:i:s', $timeString)->format($format);
    }
}

if (! function_exists('getItemByKeyValue')) {
    function getItemByKeyValue(array $array, $key, $value)
    {
        foreach ($array as $item) {
            if (isset($item[$key]) && $item[$key] === $value) {
                return $item;
            }
        }
        return null;
    }
}
