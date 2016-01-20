<div class="radio{{ ($errors->has($name)) ? ' has-error' : '' }}">
    <span class="help-block">{{ $label }}</span>
    <label class="radio-inline">
        <input type="radio" name="{{ $name }}" value="1"{{ ((1 == old($name)) ?: $model->$name) ? ' checked="checked"' : '' }}>
        Yes
    </label>
    <label class="radio-inline">
        <input type="radio" name="{{ $name }}" value="0"{{ ((0 == old($name)) ?: $model->$name) ? ' checked="checked"' : '' }}>
        No
    </label>
    {!! ($errors->has($name) ? '<p>'.$errors->first($name).'</p>' : '') !!}
</div>