@extends('proto.master')

@section('content')
    <h1>All __ ucfirst($collection)__ </h1>
        <p>
            {!! link_to_route('__$collection__.create', 'Create new __$collection__' , [] , ['class' => 'btn btn-info']) !!}
        </p>
    @if(count($__$collection__))
        <table class="table  table-hover">
            <thead>
                <tr>
                    __!foreach($fields as $field):__
                    <th>__ ucfirst($field) __</th>
                    __!endforeach;__
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($__$collection__ as $__$item__)
                <tr>
                    __!foreach($fields as $field):__

                    <td>{{$__$item__->__$field__}}</td>

                    __!endforeach;__

                    <td>{!! link_to_route('__$collection__.edit', 'Edit', [$__$item__->id], ['class' => 'btn btn-info']) !!}</td>

                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['__$collection__.destroy', $__$item__->id]]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You do not have  __$collection__  in database</p>
    @endif
@stop
