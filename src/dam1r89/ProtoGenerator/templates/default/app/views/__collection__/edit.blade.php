@include('common.errors')

{{ Form::model($item, array('method' => $method, 'route' => array($route, $item->id ))) }}
    __fields__
    <div class="form-group">
        <label>__field__</label>
        {{ Form::text('__field__', null, array( 'class'=> 'form-control' )) }}
    </div>
    __stop__
    <button type="submit" class="btn btn-default">Save</button>

{{ Form::close() }}
