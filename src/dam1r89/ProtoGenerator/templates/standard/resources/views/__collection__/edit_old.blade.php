@include('common.errors')

{{ Form::model($__$item__, array('method' => $method, 'route' => array($route, $__$item__->id ))) }}
__!foreach($fields as $field):__

__$field->get('type')__

<div class="form-group">
    <label>__ ucfirst($field) __</label>
    {{ Form::text('__$field__', null, array( 'class'=> 'form-control' )) }}
</div>
__!endforeach;__
__!foreach($belongsTos as $belongsTo):__
<div class="form-group">
    <label>__belongsTo__</label>
    {{ Form::select('__belongsTo___id', __belongsTo__::all()->lists('id', 'id'), null, array( 'class'=> 'form-control' )) }}
</div>
__!endforeach;__
<button type="submit" class="btn btn-default">Save</button>

{{ Form::close() }}
