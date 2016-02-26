<div class="form-group{{ ($errors->has($name)) ? ' has-error' : '' }}">
	<label for="{{ $name }}">{{ $label }}</label>
	<select multiple="multiple" name="{{ $name }}[]" id="{{ $name }}" class="form-control">
		@if(isset($nullable))
			<option value=""></option>
		@endif
		@foreach($items as $id => $itemLabel)
			<option value="{{ $id }}"{{ (in_array($id, old($name) ?: $model->$name->pluck('id')->toArray())) ? ' selected="selected"' : '' }}>{{ $itemLabel }}</option>
		@endforeach
	</select>
	{!! ($errors->has($name) ? '<p>'.$errors->first($name).'</p>' : '') !!}
</div>
