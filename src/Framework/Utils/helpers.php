<?php

function base_dir()
{
    $stack = debug_backtrace();
    $firstFrame = $stack[count($stack) - 1];
    return realpath(dirname($firstFrame['file']) . "/../");
}