<?php

function base_dir($path = '')
{
    $stack = debug_backtrace();
    $firstFrame = $stack[count($stack) - 1];
    return realpath(dirname($firstFrame['file']) . "/../" . $path);
}