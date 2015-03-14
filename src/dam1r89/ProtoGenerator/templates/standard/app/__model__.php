<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class __$model__ extends Model
{

    public $fillable = [__!foreach($fields as $field):__ '__$field__',__!endforeach__];

}
