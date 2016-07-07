<?php

use dam1r89\ProtoGenerator\ContextDataParser;

/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 9/2/14
 * Time: 11:32 AM
 */
class ContextDataParserTest extends PHPUnit_Framework_TestCase
{

    public function testParsingOneWordItem()
    {
        $parser = ContextDataParser::create('car', []);

        $data = $parser->getContextData();
        /**
         *
         * video_tags
         * table: video_tags
         * collection: videoTags
         * controller: VideoTags
         * item: videoTag
         * model: VideoTag
         */


        $this->assertEquals('cars', $data['table']);
        $this->assertEquals('car', $data['singleItem']);
        $this->assertEquals('cars', $data['collection']);
        $this->assertEquals('Cars', $data['controller']);
        $this->assertEquals('car', $data['item']);
        $this->assertEquals('car', $data['itemLower']);
        $this->assertEquals('Car', $data['model']);

    }

    public function testParsingTwoWordItem()
    {
        $itemNames = array('video_tags', 'video_tag');
        foreach ($itemNames as $itemName) {
            $this->parseItem($itemName);

        }


    }

    /**
     * @param $itemName
     */
    private function parseItem($itemName)
    {
        $parser = ContextDataParser::create($itemName, []);

        $data = $parser->getContextData();

        $this->assertEquals('video_tags', $data['table']);
        $this->assertEquals('video_tag', $data['singleItem']);
        $this->assertEquals('video-tags', $data['snake']);
        $this->assertEquals('video-tag', $data['singleSnake']);
        $this->assertEquals('videoTags', $data['collection']);
        $this->assertEquals('VideoTags', $data['controller']);
        $this->assertEquals('videoTag', $data['item']);
        $this->assertEquals('videotag', $data['itemLower']);
        $this->assertEquals('VideoTag', $data['model']);
    }

}
