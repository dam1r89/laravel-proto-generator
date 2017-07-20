composer.json<?php

use dam1r89\ProtoGenerator\ComposerParser;

/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 9/2/14
 * Time: 11:32 AM
 */
use PHPUnit\Framework\TestCase;

class ComposerParserTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testPullingNamespace()
    {
        $cp = ComposerParser::create(__DIR__ . '/composer.json');
        $this->assertEquals('App\\', $cp->getNamespace());
    }

    public function testBadComposer()
    {
        $cp = ComposerParser::create(__DIR__ . '/bad_composer.json');
        $this->assertEquals('def', $cp->getNamespace('def'));
    }
}
