<div class="form-group{{ ($errors->has($name)) ? ' has-error' : '' }}">
	<label for="{{ $name }}">Brand id</label>
	<select name="{{ $name }}" id="{{ $name }}" class="form-control">
		@foreach( App\Models\Brand::lists($foreinLabel, 'id') as $id => $label) 
		<option value="{{ $id }}"{{ ($id == old($name) ?: $model->$name) ? 'selected="selected"' : '' }}>{{ $label }}</option> 
		@endforeach 
	</select>
	{!! ($errors->has($name) ? '<p>'.$errors->first($name).'</p>' : '') !!}
</div>