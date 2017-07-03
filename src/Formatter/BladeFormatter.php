<?php

namespace dam1r89\ProtoGenerator\Formatter;

class BladeFormatter
{
    protected $tempReplacementNestedConditions = [];
    protected $tempReplacementNestedConditionsRepl = [];
    protected $directiveForm = [];
    protected $directiveFormRepl = [];
    protected $closing = [];
    protected $closingRepl = [];
    protected $singleDirectives = [];
    protected $singleDirectivesRepl = [];

    public function format($input)
    {
        // STEP 1.
        if (preg_match_all('/\(((?>[^()]+)|(?R))*\)/', $input, $matches)) {
            $this->tempReplacementNestedConditions = $matches[0];
            foreach ($matches[0] as $i => $match) {
                $repl = 'ᐃ' . ($i + 1) . 'ᐃ';
                $input = str_replace($match, $repl, $input);
                $this->tempReplacementNestedConditionsRepl[] = $repl;
            }
        }

        // @ifᐃ1ᐃ
        // STEP 2
        $bladeDirectives = ['if', 'component', 'section', 'foreach', 'slot'];

        if (preg_match_all('/@(' . implode('|', $bladeDirectives) . ')\s*ᐃ\d+ᐃ/', $input, $matches)) {
            $this->directiveForm = $matches[0];
            foreach ($matches[0] as $i => $match) {
                $repl = '<' . $matches[1][$i] . ' id="' . ($i + 1) . '">';
                $input = str_replace($match, $repl, $input);
                $this->directiveFormRepl[] = $repl;
            }
        }

        // STEP 3 closing
        $closing = [];
        foreach ($bladeDirectives as $directive) {
            $closing[] = 'end' . $directive;
        }

        if (preg_match_all('/@(' . implode('|', $closing) . ')/', $input, $matches)) {
            $this->closing = $matches[0];
            foreach ($matches[0] as $i => $match) {
                $tagName = substr($matches[1][$i], 3);
                $repl = '</' . $tagName . '>';
                $input = str_replace($match, $repl, $input);
                $this->closingRepl[] = $repl;
            }
        }

        // STEP 3.5
        $singleItems = ['else', 'elseif'];

        if (preg_match_all('/@(' . implode('|', $singleItems) . ')/', $input, $matches)) {
            $this->singleDirectives = $matches[0];
            foreach ($matches[0] as $i => $match) {
                $repl = '<' . $matches[1][$i] . '/>';
                $input = str_replace($match, $repl, $input);
                $this->singleDirectivesRepl[] = $repl;
            }
        }

        // STEP 5
        $output = \Mihaeu\HtmlFormatter::format($input);

        // $output = $indenter->indent($input);

        // reverse STEP 3.3
        foreach ($this->singleDirectives as $i => $original) {
            $output = str_replace($this->singleDirectivesRepl[$i], $original, $output);
        }

        if (preg_match_all('/^( *)@(' . implode('|', $singleItems) . ')/m', $output, $matches)) {
            $this->singleDirectives = $matches[0];
            foreach ($matches[0] as $i => $match) {
                $indentation = str_repeat(' ', max(0, strlen($matches[1][$i]) - 4));
                // dd(nl2br($matches[1][$i]), strlen($matches[1][$i]));
                $repl = $indentation . '@' . $matches[2][$i];
                $output = str_replace($match, $repl, $output);
                $this->singleDirectivesRepl[] = $repl;
            }
        }

        // reverse STEP 3
        foreach ($this->closing as $i => $original) {
            $output = str_replace($this->closingRepl[$i], $original, $output);
        }

        // reverse STEP 2
        foreach ($this->directiveForm as $i => $original) {
            $output = str_replace($this->directiveFormRepl[$i], $original, $output);
        }

        // revers STEP 1.
        foreach ($this->tempReplacementNestedConditions as $i => $original) {
            $output = str_replace($this->tempReplacementNestedConditionsRepl[$i], $original, $output);
        }

        return $output;
    }
}
