<?php

class Parser
{
    private $descriptions = [
        'help' => 'Get help',
        'whatever' => 'Basic function',
    ];

    public $commands = [
        'help' => 'getHelp',
        'whatever' => 'whateverFunction',
    ];

    public function getHelp()
    {
        $output = '';

        foreach ($this->commands as $key => $name) {
            $output .= '*'.$key.'* - '.$this->descriptions[$key].PHP_EOL;
        }

        return $output;
    }

    public function runCommand($command)
    {
        $keyExists = array_key_exists($command, $this->commands);
        $isCallable = is_callable($this->commands[$command]);
        $methodExists = method_exists($this, $this->commands[$command]);

        writeInputLog($keyExists ? 'KEY EXISTS' : 'KEY DOES NOT EXIST');

        writeInputLog($isCallable ? 'CALLABLE' : 'NOT CALLABLE');

        writeInputLog($methodExists ? 'METHOD EXISTS' : 'METHOD DOES NOT EXIST');

        if ($keyExists && ($isCallable || $methodExists)) {
            $result = $this->{$this->commands[$command]}();
        } else {
            $result = "I can't do that.";
        }

        return $result;
    }
}
