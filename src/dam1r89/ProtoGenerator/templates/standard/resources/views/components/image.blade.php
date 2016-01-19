<div class="form-group{{ ($errors->has('image')) ? ' has-error' : '' }}">
    <div class="row">
        <div class="col-sm-9">
            <label for="{{ $name }}">{{ $label }}</label>
            <input type="file" name="{{ $name }}" onchange="document.getElementById(this.dataset.preview).src = (window.URL || window.webkitURL).createObjectURL(this.files[0])" data-preview="{{ $name }}-preview">
            {!! ($errors->has($name) ? '<p>'.$errors->first($name).'</p>' : '') !!}
        </div>
        <div class="col-sm-3">
            @if($model->$name)
                <img class="img-responsive" src="{{ asset($model->$name) }}" alt="" id="{{$name}}-preview">
            @endif
        </div>
    </div>
</div>
