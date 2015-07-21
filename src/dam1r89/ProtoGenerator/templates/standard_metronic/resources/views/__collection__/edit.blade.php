@extends('metronic.layout.master')

@section('title','Edit __ ucfirst($singleItem)__')
@section('breadcrumb', HTML::linkRoute('__$collection__.index', 'All __ ucfirst($collection)__'))
@section('h1','Edit __ ucfirst($singleItem)__')
@section('h1button', HTML::back('__$collection__.index'))

@section('content')
    <div class="col-md-12">
        <div class="portlet box  {!! $site_settings["portlet_color"] or 'blue-hoki' !!} ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i> Edit __ ucfirst($singleItem)__
                </div>
                <div class="tools">
                    <a href="" class="collapse"></a>
                    <a href="" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
    {!!Form::model($__$item__,[ 'route' => ['__$collection__.update' ,$__$item__->id ] ,'method' => 'PATCH' ]  )!!}

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
                            {!! Form::label('__$field__','Categories:') !!}
                            {!! Form::select('__$field__[]', __$field->get("relation")["class"]__::lists('__$field->get("relation")["field"]__','id'), $__$item__->__$field__()->select('__$field__.id')->lists('id') , array('class' => 'form-control', 'placeholder' => '__ ucfirst($field) __','multiple')) !!}
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

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Submit</button>
                                {{--<button type="button" class="btn default">Cancel</button>--}}
                            </div>
                        </div>
                    </div>

                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>

@stop