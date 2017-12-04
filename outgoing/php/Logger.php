<?php

const LOGS_DIR = "./logs";

function writeToLogFile($fileName, $buffer)
{
    if (is_string($buffer)) {
        $buffer = [$buffer];
    }

    $buffer = array_map(function ($item) {
        return "\t$item";
    }, $buffer);

    // Add timestamp in first line
    array_unshift($buffer, date('m/d/y h:i a', time()));

    // Amount of arguments (before time)
    // array_unshift($buffer, '['.(count($buffer) - 1).']');

    $buffer = implode(PHP_EOL, $buffer);

    file_put_contents(LOGS_DIR."/$fileName", PHP_EOL.$buffer, FILE_APPEND);
}

function writeInputLog($buffer)
{
    writeToLogFile('webhookInput.log', $buffer);
}

function writeMessageLog($buffer)
{
    writeToLogFile('messages.log', $buffer);
}
