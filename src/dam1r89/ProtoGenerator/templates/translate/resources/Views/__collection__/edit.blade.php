@extends('proto.master')

@section('content')

    <h1>Edit __ ucfirst($singleItem)__</h1>
        <p>
            {!! link_to_route('__$collection__.index', 'All __$collection__' , [] , array('class' => 'btn btn-info','style'=>'color:white')) !!}
        </p>

    @include('proto._adminbuttons')

    {!!Form::model($__$item__,[ 'route' => ['__$collection__.update' ,$__$item__->id ] ,'method' => 'PATCH' ]  )!!}

    <div class="tab-content">
        @foreach( $locales as $lang)
            <div class="tab-pane fade  @if ($locale == $lang) in active @endif" id="content-{{ $lang }}">
                __!foreach($fields as $field):__
                __!if($field->has('translation')):__
                <div class="form-group {{ ($errors->has($lang.'.__$field__')) ? 'has-error' : '' }}">
                    {!! Form::label($lang.'[__$field__]','__ ucfirst($field) __:') !!}
                    {!! Form::text($lang.'[__$field__]', (isset($__$item__->translate($lang)->__$field__) ? $__$item__->translate($lang)->__$field__ : null ), array('class' => 'form-control', 'placeholder' => '__ ucfirst($field) __')) !!}
                    {!! ($errors->has($lang.'.__$field__') ? '<p>'.$errors->first($lang.'.__$field__').'</p>' : '') !!}
                </div>
                __!endif;__
                __!endforeach;__
            </div>
        @endforeach
    </div>
        __!foreach($fields as $field):__
        __!if(!$field->has('translation')):__
         __!if($field->has('relation')) : __ 
                     __!if($field->get("relation")["type"] == 'hasOne') : __ 
                        <div class="form-group {{ ($errors->has('__$field__')) ? 'has-error' : '' }}">
                                {!! Form::label('__$field__','__ ucfirst($field->get("relation")["name"])__:') !!}
                                {!! Form::select('__$field__', __$field->get("relation")["class"]__::all()->lists('__$field->get("relation")["field"]__','id') ,null, array('class' => 'form-control', 'placeholder' => '__ ucfirst($field) __')) !!}
                                {!! ($errors->has('__$field__') ? '<p>'.$errors->first('__$field__').'</p>' : '') !!}
                        </div>
                    __!else:__
                        <div class="form-group {{ ($errors->has('__$field__')) ? 'has-error' : '' }}">
                            {!! Form::label('__$field__','Categories:') !!}
                            {!! Form::select('__$field__[]', __$field->get("relation")["class"]__::all()->lists('__$field->get("relation")["field"]__','id'), $__$item__->__$field__()->select('__$field__.id')->lists('id') , array('class' => 'form-control', 'placeholder' => '__ ucfirst($field) __','multiple')) !!}
                            {!! ($errors->has('__$field__') ? '<p>'.$errors->first('__$field__').'</p>' : '') !!}
                        </div>
                    __!endif__
            __!else:__

<div class="form-group {{ ($errors->has('__$field__')) ? 'has-error' : '' }}">
            {!! Form::label('__$field__','__ ucfirst($field) __:') !!}
            {!! Form::text('__$field__', null, array('class' => 'form-control', 'placeholder' => '__ ucfirst($field) __')) !!}
            {!! ($errors->has('__$field__') ? '<p>'.$errors->first('__$field__').'</p>' : '') !!}
        </div>
            __!endif;__
         __!endif;__
        __!endforeach;__   

<div class="form-group">
            {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
        </div>

    {!!Form::close()!!}

@stop
