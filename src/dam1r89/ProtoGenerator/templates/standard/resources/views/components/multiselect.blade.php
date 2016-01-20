<div class="form-group{{ ($errors->has($name)) ? ' has-error' : '' }}">
	<label for="{{ $name }}">{{ $label }}</label>
	<select multiple="multiple" name="{{ $name }}" id="{{ $name }}" class="form-control">
		@foreach($items as $id => $label) 
		@if(isset($nullable))
		<option value=""></option>
		@endif
		<option value="{{ $id }}"{{ ($id == old($name) ?: $model->$name) ? 'selected="selected"' : '' }}>{{ $label }}</option> 

		@endforeach 
	</select>
	{!! ($errors->has($name) ? '<p>'.$errors->first($name).'</p>' : '') !!}
</div>