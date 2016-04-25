<?php namespace dam1r89\ProtoGenerator;

use Illuminate\Support\ServiceProvider;


class ProtoGeneratorServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function register()
    {

        $this->app->singleton('command.proto', function ($app) {
            return new ProtoCommand($app['composer']);
        });

        $this->commands('command.proto');

    }

    public function boot()
    {
        require_once __DIR__ . '/helpers.php';

        $this->publishes([
            __DIR__ . '/templates/standard' => base_path('resources/templates/standard'),
        ]);
    }

}
