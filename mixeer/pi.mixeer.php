<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use Benjivm\Mixeer\Helpers;

class Mixeer
{
    public $return_data = '';

    /**
     * Mixeer constructor.
     */
    public function __construct()
    {
        $file = ee()->TMPL->fetch_param('file');
        $manifestDir = ee()->TMPL->fetch_param('manifest_dir');

        $this->return_data = $this->mix($file, $manifestDir);
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

        if (! Helpers::startsWith($path, '/')) {
            $path = "/{$path}";
        }

        if ($manifestDir && ! Helpers::startsWith($manifestDir, '/')) {
            $manifestDir = "/{$manifestDir}";
        }

        $manifestPath = Helpers::publicPath($manifestDir . '/mix-manifest.json');

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

        return $manifestDir . $manifest[$path];
    }
}
