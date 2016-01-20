Install

    composer require "dam1r89/proto-generator" --dev 

add to `config/app.php` under providers

    dam1r89\ProtoGenerator\ProtoGeneratorServiceProvider::class,
    Illuminate\Html\HtmlServiceProvider::class

Type
    
    php artisan vendor:publish

##Example

To scafold resource with name *post* you type:

    php artisan proto post --fields='{"name":{}, "body":{}}'

fields flag is json data which is transfered to the templates.

and add bindings to the `routes.php` file:

    Route::resource('post', 'PostsController');

then go to local serving addres, for example on **http://localhost:8000/posts** and you can see simple crud application.

For hasOne relation use field name and id: `"category_id": {"label": "name"}`.

##Flags

*-r* replace files withouth asking  
*-t* template folder - default `standard`  
*-f* fields  
*-d* additional context data  
*-o* output folder - default base  

##Using from app

    use dam1r89\ProtoGenerator\ContextDataParser;
    use dam1r89\ProtoGenerator\Proto;

    $parser = new ContextDataParser('users', ['first_name', 'last_name']);
    $context = $parser->getContextData();

    $context['additional_data'] = 'whatever';


    $p = Proto::create('source/path/', base_path(), $context);
    $p->generate(true);
