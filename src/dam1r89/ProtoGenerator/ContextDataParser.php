<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 11/23/14
 * Time: 8:30 PM
 */

namespace dam1r89\ProtoGenerator;


class ContextDataParser implements ContextDataParserInterface{


    private $item, $fields;

    function __construct($item, $fields)
    {
        $this->item = $item;
        $this->fields = $fields;
    }

    public function getContextData(){

        $table = str_plural(strtolower($this->item));
        $singleItem = str_singular($table);
        $collection = camel_case($table);
        $controller = Ucfirst($collection);

        $item = str_singular($collection);
        $model = Ucfirst($item);
        $migrationDate = $this->getDatePrefix();

        if ($this->fields) {
            $fields = array_map('trim',explode(',', $this->fields));
        } else {
            $fields = array('name');
        }

        return compact('table', 'item', 'singleItem', 'model', 'controller', 'collection', 'migrationDate', 'fields');
    }

    protected function getDatePrefix()
    {
        return date('Y_m_d_His');
    }
}
