composer.json

    "require-dev": {
        "dam1r89/proto-generator": "2.0.*"
    },

add to `config/app.php` under providers

    dam1r89\ProtoGenerator\ProtoGeneratorServiceProvider::class,
    Illuminate\Html\HtmlServiceProvider::class

And to aliases:

    'Form' => Illuminate\Html\FormFacade::class,
    'HTML' => Illuminate\Html\HtmlFacade::class,

##Example

To scafold resource with name *post* you type:

    php artisan proto post --fields='{"name":{}, "body":{}}'

fields flag is json data which is transfered to the templates.

and add bindings to the `routes.php` file:

    Route::model('posts', 'App\Models\Post');
    Route::resource('posts', 'PostsController');

then go to local serving addres, for example on **http://localhost:8000/posts** and you can see simple crud application.

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
