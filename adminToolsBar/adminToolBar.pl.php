<?php
 /**
 * Created by PhpStorm.
 * Author:   ershov-ilya
 * GitHub:   https://github.com/ershov-ilya/
 * About me: http://about.me/ershov.ilya (EN)
 * Website:  http://ershov.pw/ (RU)
 * Date: 26.11.2015
 * Time: 17:21
 */

/**
 * Plugin outputs panel in web only for authorized users
 * @var modX $modx
 * @var array $scriptProperties
 */

switch ($modx->event->name) {
    case 'OnWebPagePrerender':
        if ( $modx->user->hasSessionContext('mgr') || $modx->user->isMember(array('Administrator','Manager')) ){
            $html = $modx->getChunk("adminToolBar");
            $modx->resource->_output = preg_replace("/(<\/body>)/i", $html . "\n\\1", $modx->resource->_output, true);
        }
        break;
}
