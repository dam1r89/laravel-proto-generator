<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 11/23/14
 * Time: 8:48 PM
 */

namespace dam1r89\ProtoGenerator;


class TranslatableContextDataDecorator implements ContextDataParserInterface
{


    private $parser;

    const TRANSLATABLES = 'translatables';

    const NON_TRANSLATABLES = 'nonTranslatables';

    function __construct(ContextDataParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function getContextData()
    {
        $data = $this->parser->getContextData();

        $data[self::TRANSLATABLES] = array();
        $data[self::NON_TRANSLATABLES] = array();
        foreach ($data['fields'] as $key => $field) {
            $parts = explode(':', $field);
            if (isset($parts[1]) && $this->hasFlag('t', $field)) {
                $data[self::TRANSLATABLES][] = $parts[0];
                $data['fields'][$key] = $this->pullFlag('t',$field);
            }
            else{
                $data[self::NON_TRANSLATABLES][] = $field;
            }
        }


        return $data;

    }

    public function hasFlag($flag, $field){
        $parts = explode(':', $field);
        if (isset($parts[1])) {
            return strpos($parts[1], $flag) !== false;
        }
        false;
    }

    private function pullFlag($flag, $field){

        $parts = explode(':', $field);
        if (isset($parts[1])){

            $attributes = str_replace($flag, '', $parts[1]);
            if (strlen($attributes)){
                return "{$parts[0]}:$attributes";
            }
            return $parts[0];
        }

        return $field;

    }


}
