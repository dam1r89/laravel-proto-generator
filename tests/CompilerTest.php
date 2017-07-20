<?php

use dam1r89\ProtoGenerator\UnderscoreCompiler;

/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 9/2/14
 * Time: 11:32 AM
 */

use PHPUnit\Framework\TestCase;

class CompilerTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $data = array(
            'key' => 'value'
        );

        $protoCmd = new UnderscoreCompiler($data);
        $res = $protoCmd->compile('__key__', $data);

        $this->assertEquals('value', $res);
    }

    public function testCompilingArray()
    {
        $data = array(
            'names' => ['hello', 'value']
        );

        $protoCmd = new UnderscoreCompiler($data);
        $res = $protoCmd->compile("__names__\n(__name__)\n__stop__");

        $this->assertContains('(hello)', $res);
        $this->assertContains('(value)', $res);
    }

    public function testCompilingTwoArrays()
    {
        $data = array(
            'names' => ['hello', 'value'],
            'fields' => ['one', 'two']
        );

        $protoCmd = new UnderscoreCompiler($data);
        $res = $protoCmd->compile("__names__\n(__name__)\n__stop__ __fields__<__field__>__stop__ ");

        $this->assertContains('(hello)', $res);
        $this->assertContains('(value)', $res);

        $this->assertContains('<one>', $res);
        $this->assertContains('<two>', $res);
    }

}
