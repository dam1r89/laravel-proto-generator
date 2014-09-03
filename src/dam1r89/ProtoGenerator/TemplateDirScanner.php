<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 9/2/14
 * Time: 11:31 PM
 */

namespace dam1r89\ProtoGenerator;


class TemplateDirScanner {

    private $compiler;

    function __construct($compiler)
    {

       $this->compiler = $compiler;
    }

    public function scan($sourceDir, $destDir){

        $directory = new \RecursiveDirectoryIterator($sourceDir);
        $iterator = new \RecursiveIteratorIterator($directory);
        $files = array();

        $baseLength = strlen($sourceDir);

        foreach ($iterator as $info) {

            if ($info->getFilename()[0] === '.') continue;

            $relativeSource = substr($info->getPathname(), $baseLength + 1);
            $src = $info->getPathname();

            $relativeDest = $this->compile($relativeSource);
            $dest = "$destDir/$relativeDest";

            $files[] = compact('src', 'dest');
        }

        return $files;
    }

    private function compile($string){

       return $this->compiler->compile($string);

    }
} 