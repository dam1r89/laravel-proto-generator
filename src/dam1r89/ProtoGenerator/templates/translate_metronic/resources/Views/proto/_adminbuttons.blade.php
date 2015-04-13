@if (count($locales) > 1)
    <div class="clearfix">
        <div class="btn-group pull-right" id="btn-group-form-locales">
            @foreach ($locales as $l)
                {!! Html::langButton($l, array('data-target' => '#' . 'content' .'-'. $l, 'data-toggle' => 'tab')) !!}
            @endforeach
        </div>
    </div>
@endif