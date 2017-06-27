<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 11/23/14
 * Time: 8:30 PM
 */

namespace dam1r89\ProtoGenerator;


class Field
{
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

    public function get($prop, $default = null)
    {
        if ($this->has($prop)) {
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

class ContextDataParser implements ContextDataParserInterface
{


    private $item, $fields;


    /**
     * @param $item
     * @param array $fields
     * @return ContextDataParser
     */
    public static function create($item, array $fields)
    {
        return new static($item, $fields);
    }

    private function __construct($item, array $fields = [])
    {
        $this->item = $item;
        $this->fields = $fields;
    }

    public function getContextData()
    {

        $table = str_plural(strtolower($this->item));
        $singleItem = str_singular($table);
        $collection = camel_case($table);
        $controller = Ucfirst($collection);

        $item = str_singular($collection);
        $itemLower = strtolower($item);
        $model = Ucfirst($item);
        $migrationDate = $this->getDatePrefix();

        $snake = snake_case($collection, '-');
        $singleSnake = str_singular($snake);

        $fields = [];

        foreach ($this->fields as $name => $field) {
            $fields[] = new Field($name, $field);
        }

        return compact('table', 'item', 'itemLower', 'singleItem', 'model', 'controller', 'collection', 'migrationDate', 'fields', 'snake', 'singleSnake');
    }

    protected function getDatePrefix()
    {
        return date('Y_m_d_His');
    }
}
