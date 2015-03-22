<?php namespace __$namespace__\Http\Requests;

use App\Http\Requests\Request;

class __$model__FormRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			__!foreach($fields as $field):__
				__!if($field->has('validation')) : __ 
						__!if( $field->get('validation') != 'no' ):__
						'__$field__' => '__$field->get("validation")__',
						__!endif;__
				__!else :__
						'__$field__' => 'required',
				__!endif;__
				
               
            __!endforeach;__
		];
	}

}
