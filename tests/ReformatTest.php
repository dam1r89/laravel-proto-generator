<?php

use dam1r89\ProtoGenerator\Formatter\BladeFormatter;
use dam1r89\ProtoGenerator\Formatter\Formatter;
use dam1r89\ProtoGenerator\Formatter\PhpFormatter;


/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 9/2/14
 * Time: 11:32 AM
 */

use PHPUnit\Framework\TestCase;


class ReformatTest extends TestCase
{
    public function testFormattingFile()
    {
        $testFile = __DIR__ . '/formatting/TestClass.php';
        copy(__DIR__ . '/formatting/OriginalClass.php', $testFile);
        Formatter::format($testFile);
        $this->assertEquals(file_get_contents($testFile), file_get_contents(__DIR__ . '/formatting/ResultClass.php'));
    }

    public function testFormattingPhpFragment()
    {
        $fragment = "['name' => 'Knelac', [\"thing\" =>'something','bla' => 'required'] ]";

        $output = Formatter::formatFragment($fragment);

         $this->assertEquals("['name' => 'Knelac', ['thing' =>'something', 'bla' => 'required']]", $output);


    }

    public function testFormattingPhpFragmentArguments()
    {
        $fragment = "'layout', [\"somethign\" => 32]";

        $output = Formatter::formatFragment($fragment);

         $this->assertEquals("'layout', ['somethign' => 32]", $output);


    }

    public function testFormattingBlade()
    {
        $source = __DIR__ . '/formatting/template-input.blade.php';
        $result = __DIR__ . '/formatting/template-output.blade.php';

        $input = file_get_contents($source);

        $fmt = new BladeFormatter();
        $output = $fmt->format($input);

        $this->assertEquals(file_get_contents($result), $output);
    }
}
