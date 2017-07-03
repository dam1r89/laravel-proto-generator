<?php

namespace dam1r89\ProtoGenerator\Formatter;

class Formatter
{
    public static function format($file)
    {
        if (preg_match('/.blade.php$/', $file)) {
            $fmt = new BladeFormatter();
            $output = $fmt->format(file_get_contents($file));
            file_put_contents($file, $output);
        } else {
            $fmt = new PhpFormatter();
            $fmt->format($file);
        }
    }

    public function formatPhp()
    {
        // body
    }

    public function formatBlade()
    {
        // body
    }
}
