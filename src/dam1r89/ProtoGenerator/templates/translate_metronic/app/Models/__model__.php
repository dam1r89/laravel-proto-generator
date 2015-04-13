<?php namespace __$namespace__Models;

use Illuminate\Database\Eloquent\Model;

class __$model.' '__  extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = [   __!foreach($fields as $field):__  __!if($field->has('translation')):__ '__$field__' , __! endif;__   __!endforeach__];
    public $fillable = [ __! $fields_counter =1;__  __!foreach($fields as $field):__  __!if($field->get("relation")["type"] != 'belongsToMany'):__ '__$field__' __!if(count($fields)  != $fields_counter):__ , __! endif;__  __! endif;__  __!$fields_counter++__  __!endforeach__];

    	__!foreach($fields as $field):__
				__!if($field->has('relation')) : __ 
					__!if($field->get("relation")["type"] == 'hasOne'):__

		public function __$field->get("relation")["name"]__()
		{
			return $this->__$field->get("relation")["type"]__('__$field->get("relation")["class"]__', 'id' , '__$field__' );
		}
					__!elseif($field->get("relation")["type"] == 'belongsToMany'):__
		public function __$field->get("relation")["name"]__()
		{
			return $this->__$field->get("relation")["type"]__('__$field->get("relation")["class"]__', '__$item."_".$field__' , '__$item."_id"__' , '__str_singular($field->get("relation")["name"])."_id"__' );
		}
					__!endif;__
		
					
				__!endif;__
				
               
        __!endforeach;__
}

class __$model__Translation  extends Model{

    public $timestamps = false;
    public $fillable   = [   __!foreach($fields as $field):__  __!if($field->has('translation')):__ '__$field__' , __! endif;__   __!endforeach__];

}
