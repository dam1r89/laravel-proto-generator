@extends('metronic.layout.master')

@section('title','Show __ ucfirst($singleItem)__')
@section('breadcrumb', HTML::linkRoute('__$collection__.index', 'All __ ucfirst($collection)__'))
@section('h1','Show __ ucfirst($singleItem)__')
@section('h1button', HTML::back('__$collection__.index'))

@section('content')
    <div class="col-md-12">
        @include('proto._adminbuttons')
    <div class="tab-content">
        @foreach( $locales as $lang)
            <div class=" tab-pane fade  @if ($locale == $lang) in active @endif" id="content-{{ $lang }}">


                <div class="portlet box  {!! $site_settings["portlet_color"] or 'blue-hoki' !!}">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>__ ucfirst($collection)__
                        </div>
                        <div class="actions actions-columns ">

                        </div>
                    </div>


                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="datatable_full">
                            <thead>
                            <tr>
                                __!foreach($fields as $field):__

                                __!if($field->has('relation')) : __
                                <th>__ ucfirst($field->get("relation")["name"])__</th>
                                __!else: __
                                <th>__ ucfirst($field) __</th>
                                __!endif;__

                                __!endforeach;__
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                __!foreach($fields as $field):__
                                __!if($field->has('relation')) : __
                                __!if($field->get("relation")["type"] == 'hasOne') : __
                                <td>{{$__$item__->__$field->get("relation")["name"]__->__$field->get("relation")["field"]__}}</td>
                                __!elseif($field->get("relation")["type"] == 'belongsToMany'):__
                                <td>
                                    @foreach($__$item__->__$field__()->get() as $__str_singular($field->get("relation")["name"])__)
                                        {!!$__str_singular($field->get("relation")["name"])__->__$field->get("relation")["field"]__ !!}
                                    @endforeach

                                </td>
                                __!endif__
                                __!else: __
                                __!if($field->has('translation')):__
                                <td>{{$__$item__->translate($lang)->__$field__}}</td>
                                __!else: __
                                <td>{{$__$item__->__$field__}}</td>
                                __!endif;__
                                __!endif;__
                                __!endforeach;__
                                <td>
                                    {!!HTML::edit('__$collection__.edit',$__$item__->id)!!}
                                    {!!HTML::delete('__$collection__.destroy', $__$item__->id ) !!}
                                </td>

                            </tr>
                            </tbody>

        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@stop