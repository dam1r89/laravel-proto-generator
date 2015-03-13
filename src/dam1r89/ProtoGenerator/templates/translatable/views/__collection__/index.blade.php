<p>
    <a href="{{URL::route($routeBase. 'create')}}" class="btn btn-default">Create</a>
</p>
<table class="table table-hover">
    @foreach ($collection as $item)
    <tr>
        <td>
            <a class="pull-left" href="{{URL::route($routeBase. 'show', $item->id)}}">{{$item->name}}</a>
        </td>
        <td class="text-right">
            {{ Form::open(array('route' => array($routeBase. 'destroy', $item->id ), 'method' => 'delete')) }}
            <button class="btn btn-danger" type="submit">Delete</button>
            <a href="{{URL::route($routeBase. 'edit', $item->id)}}" class="btn btn-success">Edit</a>
            {{ Form::close() }}
        </td>
    </tr>
    @endforeach
</table>