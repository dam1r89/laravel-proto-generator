@extends('proto.master')

@section('content')
    <h1>Show __ ucfirst($singleItem)__ </h1>
        <p>
            {!! link_to_route('__$collection__.index', 'All __$collection__' , [] , array('class' => 'btn btn-info','style'=>'color:white')) !!}
        </p>

        <table class="table  table-hover">
            <thead>
                <tr>
                    __!foreach($fields as $field):__
                       <th>__ ucfirst($field) __</th>
                    __!endforeach;__
                </tr>
            </thead>
            <tbody>
                 <tr>
                    __!foreach($fields as $field):__
                       <td>{{$__$item__->__$field__}}</td>
                    __!endforeach;__
                      <td>{!! link_to_route('__$collection__.edit', 'Edit', array($__$item__->id), array('class' => 'btn btn-info','style'=>'color:white')) !!}</td>
                    <td>
                        {!! Form::open(array('method' => 'DELETE', 'route' => array('__$collection__.destroy', $__$item__->id))) !!}
                            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
            </tbody>
        </table>

@stop