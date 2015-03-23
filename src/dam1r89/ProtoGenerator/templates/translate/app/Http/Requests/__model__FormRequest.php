<?php namespace __$namespace__Http\Requests;

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
        // ovo dok prepisujem u template
//        php artisan proto car --fields='{"name":{"type":"text","translation":true},"description":{"type":"text","translation":true},
//        "user_id":{"type":"integer","relation":{"class":"\\App\\User","field":"email","name":"user","type":"hasOne"}}}' --template="translate" -r
		$rules = [];
			__!foreach($fields as $field):__
				__!if($field->has('validation')) : __ 
						__!if( $field->get('validation') != 'no' ):__
                            __!if( $field->get('translation')):__
                                foreach(\Config::get('translatable.locales') as $lang)
                                {
                                    $rules[$lang.'.__$field__']  = '__$field->get("validation")__';
                                }
                            __!else: __
						    $rules['__$field__'] = '__$field->get("validation")__';
                            __!endif;__
						__!endif;__
				__!else :__
                            __!if( $field->get('translation')):__
                                foreach(\Config::get('translatable.locales') as $lang)
            {
                $rules[$lang.'.__$field__']  = 'required';
            }
                            __!else: __
            $rules['__$field__'] = 'required';
                            __!endif;__

				__!endif;__
				
               
            __!endforeach;__

return $rules;
	}

}
