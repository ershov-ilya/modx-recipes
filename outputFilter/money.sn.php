<?php
 /**
 * Created by PhpStorm.
 * Author:   ershov-ilya
 * GitHub:   https://github.com/ershov-ilya/
 * About me: http://about.me/ershov.ilya (EN)
 * Website:  http://ershov.pw/ (RU)
 * Date: 27.11.2015
 * Time: 12:17
 */

$zero=0;
$str=$input;
$str=preg_replace('/[^\d\.]/','',$str);
$str=preg_replace('/(\d{3})$/',' $1',$str);
if(preg_match('/\.(\d{1})$/',$str))$str.=0;
$str=preg_replace('/(\d+)(\d{3})\./','$1 $2.',$str);
$i=20;
while($i>0)
{
    $str=preg_replace('/(\d+)(\d{3}\s{1})/','$1 $2',$str,1,$count);
    $i--;
    if($count==0) break;
}
return $str;
