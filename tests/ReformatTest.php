<?php

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
        $testFile = __DIR__.'/formatting/TestClass.php';
        copy(__DIR__.'/formatting/OriginalClass.php', $testFile);
        Formatter::format($testFile);
        $this->assertEquals(file_get_contents($testFile), file_get_contents(__DIR__.'/formatting/ResultClass.php')); 
    }
}
