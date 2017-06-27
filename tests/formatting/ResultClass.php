<?php

namespace App\ClassNamespace;

class TestClass
{
    public function thisIsMethod($a, $b = 'default')
    {
        if ($b == 'default') {
            return ['one', 'two'];
        }
    }
}
