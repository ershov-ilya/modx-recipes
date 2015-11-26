<?php
/**
 * Plugin to compress HTML in output
 *
 * MODX event: OnWebPagePrerender
 * @var modX $modx
 */
$arr = array("     ", "    ", "   ", "  ", " ", "\t", "\r", "\n", "\r\n");
function clear_output($buffer)
{
    $search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
    $replace = array('>', '<', '\\1');
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}

$e =&$modx->event;
switch ($e->name)
{
    case "OnWebPagePrerender":
    {
        $content = $modx->resource->_output;
        $content = clear_output($content);
        $content = str_replace($arr, " ", $content);
        $modx->resource->_output = $content;
    }
        break;
}
