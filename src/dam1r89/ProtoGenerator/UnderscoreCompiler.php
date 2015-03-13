<?php

namespace dam1r89\ProtoGenerator;
/**
* Compiler
*/
class UnderscoreCompiler
{

    protected $contextData = array();

    public function setContextData($contextData)
    {
        $this->contextData = $contextData;
    }



    public function compile($string){

       return $this->doCompile($string,$this->contextData);
    }

    private function doCompile($string, $data){
        foreach ($data as $key => $value) {

            if (is_array($value)){
                $string = $this->compileEach($string, $key, $value);
            }
            else{
                $string = str_replace("__{$key}__", $value, $string);
            }
        }
        return $string;
    }


    private function compileEach($string, $key, $value)
    {
        $loopBlock = "/__{$key}__((.|\\n)*?)__stop__/i";

        return preg_replace_callback($loopBlock, function ($matches) use ($key, $value) {

            $loopBody = $matches[1];

            $each = '';
            foreach ($value as $arrayValue) {

                $data = [str_singular($key) => $arrayValue];
                $each .= $this->doCompile($loopBody, $data);

            }
            return $each;

        }, $string);
    }
}
