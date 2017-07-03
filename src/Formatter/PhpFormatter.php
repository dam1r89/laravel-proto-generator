<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 7/3/17
 * Time: 11:17 AM
 */

namespace dam1r89\ProtoGenerator\Formatter;

use PhpCsFixer\Config;
use PhpCsFixer\Console\ConfigurationResolver;
use PhpCsFixer\Error\ErrorsManager;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Runner;

class PhpFormatter
{
    /**
     * @param $inputFile
     */
    public function format($inputFile)
    {

        $path = [$inputFile];

        $finder = Finder::create()
            ->append($path);

        $config = Config::create()
            ->setRules([
                '@Symfony' => true,
                'array_syntax' => ['syntax' => 'short'],
            ])
            ->setFinder($finder);

        $errorManager = new ErrorsManager();

        $resolver = new ConfigurationResolver(
            $config,
            [
                'allow-risky' => true,
                'dry-run' => false,
                'rules' => null,
                'path-mode' => 'override',
                'using-cache' => false,
                'cache-file' => null,
                'format' => null,
                'diff' => false,
                'stop-on-violation' => false,
                'show-progress' => false,
            ],
            getcwd()
        );

        $runner = new Runner(
            $config->getFinder(),
            $resolver->getFixers(),
            $resolver->getDiffer(),
            null,
            $errorManager,
            $resolver->getLinter(),
            false,
            $resolver->getCacheManager(),
            $resolver->getDirectory(),
            false
        );

        $changed = $runner->fix();

        $invalidErrors = $errorManager->getInvalidErrors();
        $exceptionErrors = $errorManager->getExceptionErrors();
        $lintErrors = $errorManager->getLintErrors();

    }
}
