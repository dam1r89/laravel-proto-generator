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
                '@PSR2' => true,
                'binary_operator_spaces' => ['align_double_arrow' => true, ],
                'array_syntax' => ['syntax' => 'short'],
                'ordered_imports' => ['sortAlgorithm' => 'length'],
                'trailing_comma_in_multiline_array' => false
                // 'Proto/array_indentation' => true
            ])
            ->setFinder($finder);

        // $config->registerCustomFixers([new ArrayIndentationFixer()]);

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
        // dd($invalidErrors, $exceptionErrors, $lintErrors);

    }

    public function formatFragment($fragment)
    {

        $content = "<?php ___format___(\n".$fragment."\n);";

        $tmpFile = __DIR__.'/tmp.php';
        file_put_contents($tmpFile, $content);

        $fmt = new PhpFormatter();
        $fmt->format($tmpFile);

        $formatted = file_get_contents($tmpFile);
        $output = null;
        if (preg_match('/^<\?php\s+___format___\(((?:.|\s)*)\);$/', $formatted, $matches)){
            $output = trim($matches[1]);
        }
        
        // unlink($tmpFile);

        return $output;
    }
}
