 <div class="form-group{{ ($errors->has($name)) ? ' has-error' : '' }}">
 	<label for="{{ $name }}">{{ $label }}</label>
 	<input type="text" name="{{ $name }}" placeholder="{{ $label }}" id="{{ $name }}" class="form-control" value="{{ old($name) ?: $model->$name }}">
 	{!! ($errors->has($name) ? '<p>'.$errors->first($name).'</p>' : '') !!}
 </div>
