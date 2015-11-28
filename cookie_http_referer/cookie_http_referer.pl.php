<?php
 /**
 * Created by PhpStorm.
 * Author:   ershov-ilya
 * GitHub:   https://github.com/ershov-ilya/
 * About me: http://about.me/ershov.ilya (EN)
 * Website:  http://ershov.pw/ (RU)
 * Date: 28.11.2015
 * Time: 11:32
 */

/**
 * Плагин записывающий в куки HTTP_REFERER при открытии сессии
 */
if(isset($_SERVER['HTTP_REFERER']) && empty($_SESSION['HTTP_REFERER'])){
    $_SESSION['HTTP_REFERER']=$_SERVER['HTTP_REFERER'];
    setcookie('HTTP_REFERER', filter_var($_SERVER['HTTP_REFERER'], FILTER_SANITIZE_STRING), 0, '/');
}
