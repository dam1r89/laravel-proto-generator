<?php


function is_relation($field)
{
    return strtolower(substr($field, -3)) === '_id';
}

function relation_table($field)
{
    return str_plural(substr($field, 0, -3));
}

function relation_model($field)
{
    return studly_case(str_singular(relation_table($field)));
}

function relations($fields)
{
    if (!is_array($fields)) return $fields;

    $relations = [];
    foreach ($fields as $field) {
        if (is_relation($field)) {
            $relations[] = $field;
        }
    }
    return $relations;
}

function str_label($field, $trimId = true){
    
    if ($trimId && substr($field, -3) == '_id')
    {
        $field = substr($field, 0, -3);
    }
    return ucfirst(str_replace('_', ' ', snake_case($field)));
}
