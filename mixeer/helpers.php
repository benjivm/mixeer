<?php

if (!function_exists('starts_with')) {
    /**
     * Determine if a given string starts with a given character.
     *
     * @param $haystack
     * @param $needles
     * @return bool
     */
    function starts_with($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ($needle != '' && substr($haystack, 0, strlen($needle)) === (string)$needle) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('public_path')) {
    /**
     * Generate the public path to the given file.
     *
     * @param string $path
     * @return string
     */
    function public_path($path = '')
    {
        return ee()->config->item('base_path') . ($path ? '/' . ltrim($path, '/') : $path);
    }
}