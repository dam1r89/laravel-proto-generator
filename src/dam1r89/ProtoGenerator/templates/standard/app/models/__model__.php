<?php


class __$model__ extends Eloquent{

    public $fillable = array(
        __!foreach($fields as $field):__
        '__$field__',__!endforeach__);

}