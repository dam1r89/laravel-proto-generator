composer.json

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/dam1r89/laravel-proto-generator"
        }
    ],
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
*-o* output folder - default base  