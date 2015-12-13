@extends('proto.master')

@section('content')

    <h1>Edit __ ucfirst($singleItem)__</h1>
        <p>
            {!! link_to_route('__$collection__.index', 'All __$collection__' , [] , ['class' => 'btn btn-info']) !!}
        </p>


    @if($__$item__->id)
    {!!Form::model($__$item__,[ 'route' => ['__$collection__.update' ,$__$item__->id ] ,'method' => 'PATCH' ]  )!!}
    @else
    {!!Form::model($__$item__,[ 'route' => '__$collection__.store' ] )!!}
    @endif
        __!foreach($fields as $field):__
        <div class="form-group {{ ($errors->has('__$field__')) ? 'has-error' : '' }}">
            {!! Form::label('__$field__','__ ucfirst($field) __:') !!}
            __! if (is_relation($field)): __
            {!! Form::select('__$field__', App\Models\__ relation_model($field) __::lists('__$field->get('label')__', 'id'), null, array('class' => 'form-control', 'placeholder' => '__ ucfirst($field) __')) !!}
            __! else: __
            {!! Form::text('__$field__', null, ['class' => 'form-control', 'placeholder' => '__ ucfirst($field) __']) !!}
            __! endif; __
            {!! ($errors->has('__$field__') ? '<p>'.$errors->first('__$field__').'</p>' : '') !!}
        </div>

        __!endforeach;__

        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        </div>

    {!!Form::close()!!}

@stop
