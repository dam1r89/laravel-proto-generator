<?php

class __model__ extends Eloquent{

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = array(__translatables__'__translatable__',__stop__);


    public $fillable = array(__fields__'__field__',__stop__);
}
