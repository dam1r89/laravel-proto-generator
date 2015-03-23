<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 3/22/15
 * Time: 11:56 PM
 */

namespace dam1r89\ProtoGenerator;


class Proto
{

    private $sourceDir;
    private $destDir;
    private $pathCompiler;
    private $templateCompiler;


    private function __construct($source, $dest, $context)
    {
        $this->sourceDir = $source;
        $this->destDir = $dest;
        $this->pathCompiler = new UnderscoreCompiler($context);
        $this->templateCompiler = new TemplateProcessor($context);
    }

    public static function create($source, $dest, $context)
    {
        return new static($source, $dest, $context);
    }

    public function getFiles()
    {

        $dirIterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->sourceDir));
        $files = array();

        $baseLength = strlen($this->sourceDir);

        foreach ($dirIterator as $path) {

            if ($path->getFilename()[0] === '.') continue;

            $relativeSource = substr($path->getPathname(), $baseLength + 1);

            $content = $this->templateCompiler->procces(file_get_contents($path->getPathname()));

            $relativeDest = $this->pathCompiler->compile($relativeSource);
            $dest = "$this->destDir/$relativeDest";

            $files[] = (object)compact('dest', 'content');
        }

        return $files;

    }

    public function generate($force = false)
    {

        foreach ($this->getFiles() as $file) {

            $this->createDir($file->dest);


            if (file_exists($file->dest) && !$force) {
                return false;
            }

            file_put_contents($file->dest, $file->content);

        }
        return true;
    }

    private function createDir($target)
    {
        $parts = pathinfo($target);

        $dir = $parts['dirname'];

        if (!file_exists($dir)) {
            return mkdir($dir, 0777, true);
        }
        return false;
    }
}
