<?php

namespace dam1r89\ProtoGenerator;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ProtoCommand extends Command
{

    protected $name = 'proto';
    protected $description = 'Create model, views, controller, migration for a defined model. Example usage php `artisan proto user`';
    private $contextData;

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {

        $this->parseContextData();

        $compiler = new UnderscoreCompiler($this->contextData);

        $scanner = new TemplateDirScanner($compiler);

        // TODO: Switch templates
        $source = __DIR__ . '/templates/standard';
        $dest = base_path();

        $files = $scanner->scan($source, $dest);

        foreach ($files as $file) {


            $this->createDir($file['dest']);

            $source = file_get_contents($file['src']);

            if (!file_exists($file['dest']) || file_exists($file['dest']) && $this->confirm("File {$file['dest']} exists, to you want to overwrite?")) {

                file_put_contents($file['dest'], $compiler->compile($source));
                $this->info("Generating {$file['dest']}");

            }

        }

        $info = $compiler->compile("add to the routes:\n\tRoute::model('__collection__', '__model__');\n\tRoute::resource('__collection__', '__controller__Controller');\n\n");

        $this->call('dump-autoload');

        $this->info($info);


    }

    private function parseContextData()
    {

        $item = $this->argument('model');

        $model = Ucfirst(camel_case($item));
        $controller = str_plural($model);
        $collection = lcfirst($controller);
        $migrationDate = $this->getDatePrefix();

        if ($this->option('fields')) {
            $fields = explode(',', $this->option('fields'));
        } else {
            $fields = array('name');
        }

        $this->contextData = compact('item', 'model', 'controller', 'collection', 'migrationDate', 'fields');
    }

    protected function getDatePrefix()
    {
        return date('Y_m_d_His');
    }

    private function createDir($target)
    {
        $parts = pathinfo($target);

        $dir = $parts['dirname'];

        if (!file_exists($dir)) {
            return mkdir($dir, 0777, true);
        }
        return false;
    }

    protected function getArguments()
    {
        return array(
            array('model', InputArgument::REQUIRED, 'Model for which you want to generate prototype model, controller, views and migration.'),
        );
    }

    protected function getOptions()
    {
        return array(
            array('fields', null, InputOption::VALUE_OPTIONAL, 'Model properties separated by comma (id field is included). Example --fields="name,category,test"', null),
        );
    }

}
