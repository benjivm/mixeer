<?php

namespace Benjivm\Mixeer;

class helpers
{
    /**
     * Determine if a given string starts with a given character.
     *
     * @param $haystack
     * @param $needles
     *
     * @return bool
     */
    public static function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle != '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate the public path to the given file.
     *
     * @param string $path
     *
     * @return string
     */
    public static function publicPath($path = '')
    {
        return ee()->config->item('base_path') . ($path ? '/' . ltrim($path, '/') : $path);
    }
}
