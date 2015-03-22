composer.json<?php

use dam1r89\ProtoGenerator\ComposerParser;

/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 9/2/14
 * Time: 11:32 AM
 */
class ComposerParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testPullingNamespace()
    {
        $cp = new ComposerParser(__DIR__ . '/composer.json');
        $this->assertEquals('App\\', $cp->getNamespace());
    }

    public function testBadComposer()
    {
        $cp = new ComposerParser(__DIR__ . '/bad_composer.json');
        $this->assertEquals('def', $cp->getNamespace('def'));
    }
}
