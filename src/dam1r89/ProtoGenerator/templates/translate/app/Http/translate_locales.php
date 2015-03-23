<?php
HTML::macro('langButton', function ($locale = null, $attributes = []) {

    $inputs = Input::except('locale');
    $inputs['locale'] = $locale;

    $attributes['class'] = 'btn btn-default btn-xs  ';
    if ($locale == Config::get('app.locale')) {
        $attributes['class'] .= ' active';
    }

    $label = $locale;
    $attributes['href'] = '?' . http_build_query($inputs);

    return '<a ' . HTML::attributes($attributes) . '>' . $label . '</a>';

});





App::singleton('locales_translations', function(){
    return \Config::get('translatable.locales');
});
View::share('locales', app('locales_translations'));

App::singleton('current_locale', function(){
    return \App::getLocale();
});
View::share('locale', app('current_locale'));