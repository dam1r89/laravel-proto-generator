<div class="form-group{{ ($errors->has($name)) ? ' has-error' : '' }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-control">
        @if(isset($nullable))
            <option value="">{{ $nullable }}</option>
        @endif
        @foreach( $items as $id => $label)
            <option value="{{ $id }}"{{ ($id == (old($name) ?: $model->$name)) ? ' selected="selected"' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    {!! ($errors->has($name) ? '<p>'.$errors->first($name).'</p>' : '') !!}
</div>
