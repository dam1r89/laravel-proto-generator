composer.json

    "require-dev": {
        "dam1r89/proto-generator": "2.0.*"
    },

add to `app/config/app.php`

        'dam1r89\ProtoGenerator\ProtoGeneratorServiceProvider'

##Example

    php artisan proto post --fields='{"name":{}, "body":{}}'

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
