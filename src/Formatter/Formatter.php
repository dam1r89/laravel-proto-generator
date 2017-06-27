<?php

namespace dam1r89\ProtoGenerator\Formatter;

class Formatter
{
    public static function format($file)
    {

        if (file_exists($file)) {
            exec(sprintf(' php %s fix %s  --config=%s --allow-risky=yes',
                __DIR__ . '/../../vendor/bin/php-cs-fixer',
                $file,
                __DIR__ . '/.php_cs.dist'
            ));
        }
    }
}
