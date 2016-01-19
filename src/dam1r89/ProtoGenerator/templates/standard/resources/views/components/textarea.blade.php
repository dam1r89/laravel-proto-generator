 <div class="form-group{{ ($errors->has($name)) ? ' has-error' : '' }}">
 	<label for="{{ $name }}">{{ $label }}</label>
 	<textarea type="text" name="{{ $name }}" placeholder="{{ $label }}" id="{{ $name }}" class="form-control">{{ old($name) ?: $model->$name }}</textarea>
 	{!! ($errors->has($name) ? '<p>'.$errors->first($name).'</p>' : '') !!}
 </div>