<?php
 /**
 * Created by PhpStorm.
 * Author:   ershov-ilya
 * GitHub:   https://github.com/ershov-ilya/
 * Website:  http://ershov.pw/ (RU/ENG)
 * Date: 12.04.2016
 * Time: 12:10
 */

//$start=microtime(true);

$path=substr(MODX_BASE_PATH,0,-1);
$file=$input;

//print $path.$file.PHP_EOL;
//print $file.PHP_EOL;

$filemtime=filemtime($path.$file);
//print date('Y-m-d H:i:s', $filemtime).PHP_EOL;
$filesize=filesize($path.$file);
//print "Filesize: $filesize\n";

$hash_source=$filemtime.'_'.$filesize.'_'.$file;
//print "MD5 src:".$hash_source.PHP_EOL;
$md5s=md5($hash_source);
//print "MD5 res:".$md5s.PHP_EOL;

$thumb=$modx->runSnippet("phpthumbon", array(
    'input' => $file,
    'options' => $options."&md5s=$md5s"
));

//print $thumb.PHP_EOL;
//print (microtime(true)-$start).PHP_EOL;
//exit;
return $thumb;
