<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 3/22/15
 * Time: 11:59 PM
 */

namespace dam1r89\ProtoGenerator;


class ComposerParser {

    private $composer;

    const APP_FOLDER = 'app/';

    function __construct($filename)
    {
        $this->composer = json_decode(file_get_contents($filename), true);

    }

    public function getNamespace($default = null){
        if (!isset($this->composer['autoload']) || !isset($this->composer['autoload']['psr-4'])){
            return $default;
        }
        $psr4 = $this->composer['autoload']['psr-4'];
        foreach($psr4 as $namespace => $folder){
            if ($folder === self::APP_FOLDER){
                return $namespace;
            }
        }
        return $default;
    }
}
