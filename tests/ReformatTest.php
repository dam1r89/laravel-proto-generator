<?php

use dam1r89\ProtoGenerator\Formatter\BladeFormatter;
use dam1r89\ProtoGenerator\Formatter\Formatter;


/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 9/2/14
 * Time: 11:32 AM
 */
class ReformatTest extends PHPUnit_Framework_TestCase
{
    public function testFormattingFile()
    {
        $testFile = __DIR__ . '/formatting/TestClass.php';
        copy(__DIR__ . '/formatting/OriginalClass.php', $testFile);
        Formatter::format($testFile);
        $this->assertEquals(file_get_contents($testFile), file_get_contents(__DIR__ . '/formatting/ResultClass.php'));
    }

    public function testFormattingBlade()
    {
        $source = __DIR__ . '/formatting/template-orig.blade.php';
        $result = __DIR__ . '/formatting/template-result.blade.php';

        $input = file_get_contents($source);

        $fmt = new BladeFormatter();
        $output = $fmt->format($input);

        $this->assertEquals(file_get_contents($result), $output);

        $this->assertEquals(
            preg_replace('/\s*/', '', $input),
            preg_replace('/\s*/', '', $output),
            'Results should have same content'
        );

    }
}
