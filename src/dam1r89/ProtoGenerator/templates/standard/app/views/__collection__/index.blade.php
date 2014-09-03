<p>
    <a href="{{URL::route('__collection__.create')}}" class="btn btn-default">Create</a>
</p>
<table class="table table-hover">
    @foreach ($collection as $__item__)
    <tr>
        <td>
            <a class="pull-left" href="{{URL::route('__collection__.show', $__item__->id)}}">{{$__item__->name}}</a>
        </td>
        <td class="text-right">
            {{ Form::open(array('route' => array('__collection__.destroy', $__item__->id ), 'method' => 'delete')) }}
            <button class="btn btn-danger" type="submit">Delete</button>
            <a href="{{URL::route('__collection__.edit', $__item__->id)}}" class="btn btn-success">Edit</a>
            {{ Form::close() }}
        </td>
    </tr>
    @endforeach
</table>