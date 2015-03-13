<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 11/23/14
 * Time: 8:48 PM
 */

namespace dam1r89\ProtoGenerator;


class RelationsContextDataDecorator implements ContextDataParserInterface
{


    private $parser;

    const BELONGS_TO = 'belongsTos';

    const HAS_MANY = 'hasMany';

    function __construct(ContextDataParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function getContextData()
    {
        $data = $this->parser->getContextData();

        $data[self::BELONGS_TO] = array();
        $data[self::HAS_MANY] = array();
        foreach ($data['fields'] as $key => $field) {

            if ($this->hasFlag('n', $field)){
               $data['fields'][$key] = $this->pullFlag('n', $field);
               $data[self::HAS_MANY][] = $this->pullField($field);
            }

            if ($this->hasFlag('1', $field)){
                $data['fields'][$key] = $this->pullFlag('1', $field);
                $data[self::BELONGS_TO][] = camel_case(str_replace('_id','',$this->pullField($field)));
            }
        }

        return $data;

    }

    private function pullField($field){
        return explode(':', $field)[0];
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
