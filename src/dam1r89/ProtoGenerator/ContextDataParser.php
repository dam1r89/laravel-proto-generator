<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 11/23/14
 * Time: 8:30 PM
 */

namespace dam1r89\ProtoGenerator;


class Field{
    private $name;
    private $properies;

    function __construct($name, $properies)
    {
        $this->name = $name;
        $this->properies = $properies;
    }

    public function getName()
    {
        return $this->name;
    }

    public function get($prop, $default = null){
        if ($this->has($prop)){
            return $this->properies[$prop];
        }
        return $default;
    }

    public function has($prop)
    {
       return isset($this->properies[$prop]);
    }

    function __toString()
    {
        return $this->name;
    }


}

class ContextDataParser implements ContextDataParserInterface{


    private $item, $fieldsString;

    function __construct($item, $fields)
    {
        $this->item = $item;
        $this->fieldsString = $fields;
    }

    public function getContextData(){

        $table = str_plural(strtolower($this->item));
        $singleItem = str_singular($table);
        $collection = camel_case($table);
        $controller = Ucfirst($collection);

        $item = str_singular($collection);
        $model = Ucfirst($item);
        $migrationDate = $this->getDatePrefix();

        $fields = [];
        if ($this->fieldsString) {
            $jsonFields = json_decode($this->fieldsString, true);
            if ($jsonFields === null){
                echo "Bad input arguments\n";
                die();
            }
            foreach ($jsonFields as $name => $field) {
                $fields[] = new Field($name, $field);
            }


        }

        return compact('table', 'item', 'singleItem', 'model', 'controller', 'collection', 'migrationDate', 'fields');
    }

    protected function getDatePrefix()
    {
        return date('Y_m_d_His');
    }
}
