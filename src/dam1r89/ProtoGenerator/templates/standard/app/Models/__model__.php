<?php namespace __$namespace__Models;

use Illuminate\Database\Eloquent\Model;

class __$model.' '__  extends Model
{
    public $fillable = [ __!foreach($fields as $field):__ '__$field__', __!endforeach__];

    __!foreach(relations($fields) as $field):__

    public function __ camel_case(str_singular(relation_table($field))) __()
    {
        return $this->hasOne(__ relation_model($field) __::class);
    }
    __!endforeach__

}
