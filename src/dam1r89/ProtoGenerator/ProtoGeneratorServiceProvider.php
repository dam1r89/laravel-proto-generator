<?php namespace dam1r89\ProtoGenerator;

use Illuminate\Support\ServiceProvider;


class ProtoGeneratorServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app['command.proto'] = $this->app->share(function () {
            return $this->app->make('dam1r89\ProtoGenerator\ProtoCommand');
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

    public function provides()
    {
        return [];
    }

}
