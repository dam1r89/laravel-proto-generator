{{--@include('common.errors')--}}

{{ Form::model($item, array('method' => $method, 'route' => array($route, $item->id ))) }}
    __nonTranslatables__
    <div class="form-group">
        <label>__nonTranslatable__</label>
        {{ Form::text('__nonTranslatable__', null, array( 'class'=> 'form-control' )) }}
    </div>
    __stop__
    <h4>Translatables:</h4>
    __translatables__
    <div class="form-group">
        <label>__translatable__</label>
        {{ Form::text('__translatable__', null, array( 'class'=> 'form-control' )) }}
    </div>
    __stop__
    <button type="submit" class="btn btn-default">Save</button>

{{ Form::close() }}
