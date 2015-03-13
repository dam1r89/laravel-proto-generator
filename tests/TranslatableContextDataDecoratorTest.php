<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 11/23/14
 * Time: 8:48 PM
 */

use \dam1r89\ProtoGenerator\ContextDataParser;
use \dam1r89\ProtoGenerator\TranslatableContextDataDecorator;

class TranslatableContextDataDecoratorTest extends PHPUnit_Framework_TestCase{


    function testNormalUsage()
    {
        $parser =  new ContextDataParser('question', 'orderNumber, title');

        $translatableParser = new TranslatableContextDataDecorator($parser);

        $data = $translatableParser->getContextData();

        $this->assertEquals(2, count($data['fields']));

    }

    function testSplittingTranslatableFields()
    {
        $parser =  new ContextDataParser('question', 'orderNumber, title:t');

        $translatableParser = new TranslatableContextDataDecorator($parser);

        $data = $translatableParser->getContextData();

        $this->assertEquals(1, count($data['nonTranslatables']));
        $this->assertEquals('orderNumber', $data['nonTranslatables'][0]);
        $this->assertEquals(1, count($data['translatables']));
        $this->assertEquals('title', $data['translatables'][0]);
        $this->assertEquals(2, count($data['fields']));

    }

    function testRemovingFlag()
    {
        $parser =  new ContextDataParser('question', 'orderNumber:t, title:tn1');

        $translatableParser = new TranslatableContextDataDecorator($parser);

        $data = $translatableParser->getContextData();

        $this->assertEquals('orderNumber', $data['fields'][0]);
        $this->assertEquals('title:n1', $data['fields'][1]);

    }
}
