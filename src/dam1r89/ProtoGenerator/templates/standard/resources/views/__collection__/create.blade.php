@extends('proto.master')

@section('content')
    <h1>Create New __ ucfirst($singleItem)__ </h1>
        <p>
             {!! link_to_route('__$collection__.index', 'All __$collection__' , [] , array('class' => 'btn btn-info','style'=>'color:white')) !!}
        </p>

    {!!Form::model($__$item__,[ 'route' => '__$collection__.store' ] )!!}

        __!foreach($fields as $field):__
            __!if($field->has('relation')) : __ 
                     __!if($field->get("relation")["type"] == 'hasOne') : __ 
                        <div class="form-group {{ ($errors->has('__$field__')) ? 'has-error' : '' }}">
                                {!! Form::label('__$field__','__ ucfirst($field->get("relation")["name"])__:') !!}
                                {!! Form::select('__$field__', __$field->get("relation")["class"]__::lists('__$field->get("relation")["field"]__','id') ,null, array('class' => 'form-control', 'placeholder' => '__ ucfirst($field) __')) !!}
                                {!! ($errors->has('__$field__') ? '<p>'.$errors->first('__$field__').'</p>' : '') !!}
                        </div>
                     __!else:__
                    <div class="form-group {{ ($errors->has('__$field__')) ? 'has-error' : '' }}">
                        {!! Form::label('__$field__','__ ucfirst($field->get("relation")["name"])__:') !!}
                        {!! Form::select('__$field__[]', __$field->get("relation")["class"]__::lists('__$field->get("relation")["field"]__','id'),null, array('class' => 'form-control', 'placeholder' => '__ ucfirst($field) __','multiple')) !!}
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

        __!endforeach;__       
       
        <div class="form-group">
            {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
        </div>

    {!!Form::close()!!}

@stop