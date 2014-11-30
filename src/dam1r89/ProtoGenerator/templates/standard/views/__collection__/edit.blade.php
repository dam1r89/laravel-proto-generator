@include('common.errors')

{{ Form::model($__item__, array('method' => $method, 'route' => array($route, $__item__->id ))) }}
    __fields__
    <div class="form-group">
        <label>__field__</label>
        {{ Form::text('__field__', null, array( 'class'=> 'form-control' )) }}
    </div>
    __stop__
    __belongsTos__
    <div class="form-group">
        <label>__belongsTo__</label>
        {{ Form::select('__belongsTo___id', __belongsTo__::all()->lists('id', 'id'), null, array( 'class'=> 'form-control' )) }}
    </div>
    __stop__
    <button type="submit" class="btn btn-default">Save</button>

{{ Form::close() }}
