<p>
    <a href="{{URL::route('__$collection__.create')}}" class="btn btn-default">Create</a>
</p>
<table class="table table-hover">
    @foreach ($collection as $__$item__)
        <tr>
            <td>
                <a class="pull-left" href="{{URL::route('__$collection__.show', $__$item__->id)}}">{{$__$item__->name}}</a>
            </td>
            <td class="text-right">
                {{ Form::open(array('route' => array('__$collection__.destroy', $__$item__->__$fields[0]__ ), 'method' => 'delete')) }}
                <button class="btn btn-danger" type="submit">Delete</button>
                <a href="{{URL::route('__$collection__.edit', $__$item__->id)}}" class="btn btn-success">Edit</a>
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
</table>