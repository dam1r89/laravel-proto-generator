<?php
/**
 * Created by PhpStorm.
 * User: dam1r89
 * Date: 3/12/15
 * Time: 12:58 PM
 */

namespace dam1r89\ProtoGenerator;


class TemplateProcessor{

    public function procces($data, $context)
    {

        $data = $this->escape($data, ['<?php', '?>']);

        $data = preg_replace('/__!\s*((.|\n|\r)*?)\s*__\h*\n?\h*/', '<?php $1; ?>', $data);
        $data = preg_replace('/__\s*((.|\n|\r)*?)\s*__\h*\n?\h*/', '<?php echo $1; ?>', $data);


        foreach ($context as $key => $value) {
            $$key = $value;
        }
        file_put_contents(storage_path('__template.tmp'), $data);
        ob_start();
        require storage_path('__template.tmp');
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
