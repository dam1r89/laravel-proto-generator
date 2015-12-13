<?php namespace __$namespace__Models;

use Illuminate\Database\Eloquent\Model;

class __$model.' '__  extends Model
{
    public $fillable = [ __!foreach($fields as $field):__ '__$field__', __!endforeach__];

}
