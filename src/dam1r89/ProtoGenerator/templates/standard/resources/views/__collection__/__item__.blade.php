@extends('proto.master')

@section('content')

    <h4>Edit __ ucfirst($singleItem)__</h4>
        <p>
            <a href="{{ route('__$itemLower__.index') }}" class="btn btn-info">
                All __str_label($table)__
            </a>
        </p>
    @if($__$item__->id)
        <form action="{{ route('__$itemLower__.update', $__$item__->id) }}" method="post">
            {!! method_field('patch') !!}
    @else
        <form action="{{ route('__$itemLower__.store') }}" method="post">
    @endif
        {!! csrf_field() !!}
        __!foreach($fields as $field):__
            __! if (is_relation($field)): __
 @include('components.select', ['model' => $__$item__,'name' => '__$field__', 'label' => '__str_label($field)__',
  'items' => App\Models\__relation_model($field)__::lists('__$field->get('label','id')__', 'id'), 'nullable' => '__$field->get('nullable','')__'])

            __! else: __
 @include('components.__$field->get('type','input')__', ['model' => $__$item__,'name' => '__$field__', 'label' => '__str_label($field)__'])
            __! endif; __

        __!endforeach;__

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>

@stop
