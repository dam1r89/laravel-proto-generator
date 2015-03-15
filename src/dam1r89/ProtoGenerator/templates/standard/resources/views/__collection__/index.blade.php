@extends('proto.master')

@section('content')
    <h1>All __ ucfirst($collection)__ </h1>
        <p>
            {!! link_to_route('__$collection__.create', 'Create new __$collection__' , [] , array('class' => 'btn btn-info','style'=>'color:white')) !!}
        </p>
    @if(count($__$collection__))
        <table class="table  table-hover">
            <thead>
                <tr>
                    __!foreach($fields as $field):__
                         __!if($field->has('relation')) : __
                            <th>__ ucfirst($field->get("relation")["name"])__</th>
                         __!else: __
                            <th>__ ucfirst($field) __</th>
                         __!endif;__
                       
                    __!endforeach;__
                </tr>
            </thead>
            <tbody>
                @foreach($__$collection.' '__ as $__$item__)
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
                                 <td>{{$__$item__->__$field__}}</td>
                            __!endif;__
                    __!endforeach;__
                      <td>{!! link_to_route('__$collection__.edit', 'Edit', array($__$item__->id), array('class' => 'btn btn-info','style'=>'color:white')) !!}</td>
                    <td>
                        {!! Form::open(array('method' => 'DELETE', 'route' => array('__$collection__.destroy', $__$item__->id))) !!}
                            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You do not have  __ ucfirst($singleItem).' '__   in database</p>
    @endif
@stop