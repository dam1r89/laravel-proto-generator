
composer.json

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/dam1r89/laravel-proto-generator"
        }
    ],
    "require-dev": {
        "dam1r89/proto-generator": "dev-master"
    },

add to `app/config/app.php`

        'dam1r89\ProtoGenerator\ProtoGeneratorServiceProvider'