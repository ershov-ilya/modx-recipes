<?php
 /**
 * Created by PhpStorm.
 * Author:   ershov-ilya
 * GitHub:   https://github.com/ershov-ilya/
 * Website:  http://ershov.pw/ (RU/ENG)
 * Date: 25.02.2016
 * Time: 16:08
 */

$d = $hook->getValue('birthday-day');
$m = $hook->getValue('birthday-month');
$y = $hook->getValue('birthday-year');
//$d = ($d < 10) ? '0'.$d : $d;

$errorMsg = mktime(1, 0, 0, $m, $d, $y);
$profile = $hook->getValue('updateprofile.profile');
$profile->set('dob', $errorMsg);
$profile->save();
return true;
