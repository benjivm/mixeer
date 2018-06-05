<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once PATH_THIRD . 'mixeer/helpers.php';

class Mixeer
{
    public $return_data = '';

    /**
     * Mixeer constructor.
     */
    public function __construct()
    {
        $this->return_data = $this->mix(ee()->TMPL->fetch_param('file'), ee()->TMPL->fetch_param('manifest_dir'));
    }

    /**
     * Mix it up.
     *
     * @param $path
     * @param string $manifestDirectory
     * @return string
     * @throws Exception
     */
    function mix($path, $manifestDirectory = '')
    {
        static $manifests = [];

        if (!starts_with($path, '/')) {
            $path = "/{$path}";
        }

        if ($manifestDirectory && !starts_with($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        $manifestPath = public_path($manifestDirectory . '/mix-manifest.json');

        if (!isset($manifests[$manifestPath])) {
            if (!file_exists($manifestPath)) {
                throw new Exception("The Mix manifest does not exist at specified location: {$manifestPath}");
            }

            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
        }

        $manifest = $manifests[$manifestPath];

        if (!isset($manifest[$path])) {
            throw new Exception(
                "Unable to locate Mix file: {$path}. Please check your " .
                'webpack.mix.js output paths and try again.'
            );
        }

        return $manifestDirectory . $manifest[$path];
    }
}
