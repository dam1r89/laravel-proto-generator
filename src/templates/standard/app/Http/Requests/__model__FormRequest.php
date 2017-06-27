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
		return [
			__!foreach($fields as $field):__
                '__$field__' => 'required',
            __!endforeach;__
		];
	}

}
