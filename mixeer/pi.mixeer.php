<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mixeer
{
    public $return_data = '';

    /**
     * Mixeer constructor.
     */
    public function __construct()
    {
        $this->return_data = $this->mix(
            ee()->TMPL->fetch_param('file'),
            ee()->TMPL->fetch_param('manifest_dir')
        );
    }

    /**
     * Mix it up.
     *
     * @param $path
     * @param string $manifestDir
     *
     * @throws Exception
     *
     * @return string
     */
    public function mix($path, $manifestDir = '')
    {
        static $manifests = [];

        if (! $this->startsWith($path, '/')) {
            $path = "/{$path}";
        }

        if ($manifestDir && ! $this->startsWith($manifestDir, '/')) {
            $manifestDir = "/{$manifestDir}";
        }

        $manifestPath = $this->publicPath($manifestDir . '/mix-manifest.json');

        if (! isset($manifests[$manifestPath])) {
            if (! file_exists($manifestPath)) {
                throw new Exception("The Mix manifest does not exist: {$manifestPath}");
            }

            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
        }

        $manifest = $manifests[$manifestPath];

        if (! isset($manifest[$path])) {
            throw new Exception(
                "Unable to locate Mix file: {$path}."
            );
        }

        return (string) $manifestDir . $manifest[$path];
    }

    /**
     * Determine if a given string starts with a given character.
     *
     * @param $haystack
     * @param $needles
     *
     * @return bool
     */
    private static function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ((string) $needle !== '' && strncmp($haystack, $needle, strlen($needle)) === 0) {
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
    private static function publicPath($path = '')
    {
        return ee()->config->item('base_path') . ($path ? '/' . ltrim($path, '/') : $path);
    }
}
