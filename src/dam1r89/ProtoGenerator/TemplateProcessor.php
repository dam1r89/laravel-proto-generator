<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 3/12/15
 * Time: 12:58 PM
 */

namespace dam1r89\ProtoGenerator;


class TemplateProcessor{

    private $context;

    function __construct($context)
    {
        $this->context = $context;
    }


    public function procces($data)
    {


        $data = $this->escape($data, ['<?php', '?>']);

        $data = preg_replace('/__!\s*((.|\n|\r)*?)\s*__/', '<?php $1; ?>' , $data);
        $data = preg_replace('/__\s*((.|\n|\r)*?)\s*__/', '<?php echo $1; ?>', $data);


        foreach ($this->context as $key => $value) {
            $$key = $value;
        }
        file_put_contents(storage_path('app/template.tmp'), $data);
        ob_start();
        require storage_path('app/template.tmp');
        $data = ob_get_clean();

        return $this->unEscape($data, ['<?php', '?>']);
    }

    private function escape($data, $params){
        foreach ($params as $value) {
            $data = str_replace($value, htmlentities($value), $data);
        }
        return $data;
    }
    private function unEscape($data, $params){
        foreach ($params as $value) {
            $data = str_replace(htmlentities($value), $value, $data);
        }
        return $data;
    }

}
