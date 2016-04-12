<?php
 /**
 * Created by PhpStorm.
 * Author:   ershov-ilya
 * GitHub:   https://github.com/ershov-ilya/
 * Website:  http://ershov.pw/ (RU/ENG)
 * Date: 12.04.2016
 * Time: 12:09
 */

$path=substr(MODX_BASE_PATH,0,-1);

$size=filesize($path.$input);

$thumb=$modx->runSnippet("phpthumbon", array(
    'input' => $input,
    'options' => $options."&md5s=$size"
));

return $thumb;
