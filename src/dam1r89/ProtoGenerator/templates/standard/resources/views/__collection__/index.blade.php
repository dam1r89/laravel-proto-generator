@extends('proto.master')

@section('content')
    <h4>All __ str_label($table)__ </h4>
        <p>
            <a href="{{ route('__$itemLower__.create') }}" class="btn btn-info">
            Create __str_label($singleItem)__</a>
        </p>
    @if(count($__$collection__))
        <table class="table table-condensed table-hover">
            <thead>
                <tr>
                    __!foreach($fields as $field):__
                    <th> __str_label($field)__</th>
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

                    <td>
                        <a href="{{ route('__$itemLower__.edit', $__$item__->id) }}" class="btn btn-xs btn-info">
                            Edit
                        </a>

                    <td>
                        <form action="{{ route('__$itemLower__.destroy', $__$item__->id) }}" method="post">
                            {!! csrf_field() !!}
                            {!! method_field('delete') !!}
                            <button type="submit" class="btn btn-xs btn-danger">
                                Delete 
                            </button> 
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {!!  $__$collection__->render() !!}
        </div>
    @else
        <p>You do not have  __str_replace('_', ' ',$table)__ in database</p>
    @endif
@stop
