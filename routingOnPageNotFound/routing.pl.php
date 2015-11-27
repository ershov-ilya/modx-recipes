<?php
 /**
 * Created by PhpStorm.
 * Author:   ershov-ilya
 * GitHub:   https://github.com/ershov-ilya/
 * About me: http://about.me/ershov.ilya (EN)
 * Website:  http://ershov.pw/ (RU)
 * Date: 27.11.2015
 * Time: 10:19
 */

/**
 * MOODX Event: OnPageNotFound
 *
 * @var modX $modx
 */

// MODX check
if(gettype($modx)=='NULL') {die;}

defined('MODX_API_MODE') or define('MODX_API_MODE', false);

include_once($_SERVER['DOCUMENT_ROOT']."/assets/function.php");
$path = MODX_CORE_PATH.$modx->getOption("custom_cache");


if ($modx->event->name == 'OnPageNotFound')
{
    $REDIRECT_URL = $_SERVER['REDIRECT_URL'];
    $error_page_id=$modx->getOption('error_page');

    $alias = $modx->context->getOption('request_param_alias', 'q');
    if (!isset($_REQUEST[$alias])) {return false;}
    $request = $_REQUEST[$alias];
    $tmp = explode('/', $request);

    $count = count($tmp)-1;
    $stuff = $tmp[$count];

    $tmp = explode("_", $stuff, 2);
    $stuff_code_1c = $tmp[0];
    $stuff_code_1c=preg_replace('/[^\d]/','',$stuff_code_1c);

    include_once(MODX_BASE_PATH."/api/core/config/pdo.private.config.php");
    include_once(MODX_BASE_PATH."/api/core/class/database/database.class.php");

    $db=new Database($pdoconfig);
    $item=$db->getOne('modx_items', $stuff_code_1c, 'code_1c');
    if(empty($item)) return false;

    if(!empty($item) && $REDIRECT_URL!='/'.$item['uri']) $modx->sendRedirect($item['uri'],array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));

    $result=array();
    $result[0]=$item;

    $brend = $result[0]['brend'];
    $brend = str_replace('"', '', $brend);

    $st_page = $modx->getObject('modResource', array("pagetitle:LIKE" => $brend, "parent" => "2"));

    $sql_brand = "SELECT uri FROM modx_site_content WHERE pagetitle='".$result[0]['brend']."' AND parent = 2";
    $result_brand = getQuery($sql_brand, $path);
    //var_dump($result_brand);
    if ($result_brand[0]['uri']) $brandlink = '<a href="'.$result_brand[0]['uri'].'">'.$result[0]['brend'].'</a>';
    else $brandlink = $result[0]['brend'];

    if (is_object($st_page))
    {
        $st_image = $st_page->getTVValue('image');
        $b_image = $modx->runSnippet("pthumb", array("input" => $st_image, "options" =>"&w=132" ));
        if ($result_brand[0]['uri']) $b_image = '<a href="'.$result_brand[0]['uri'].'"><img src="'.$b_image.'" alt="'.$result[0]['brend'].'"></a>';
        else $b_image = '<img src="'.$b_image.'" alt="'.$result[0]['brend'].'">';
    }

    if (count($tmp)>1)
    {
        $sql = "SELECT * FROM modx_items_images WHERE item_code_1c='".$stuff_code_1c."'";
        $result_img = getQuery($sql, $path);

        $stuff_img_html = $modx->getChunk("stuff_images_rows", array());

        unset($stuff_images);

        //если фотография одна, то избавляемся от слайдера
        $num_imgs = count($result_img);
        foreach($result_img as $img)
        {
            $url = $modx->getOption("upload_dir").$img['name'];
            $r['url'] = $url;
            if ($num_imgs == 1) $stuff_images = $url;
            else $stuff_images .= getChunk($stuff_img_html, $r);
        }

        if ($num_imgs == 1) $stuff_images = "<div class=\"item-photo-one\"><img src=\"".$stuff_images."\" alt=\"".htmlspecialchars($result[0]['name'])."\" class=\"im\"></div>";
        else $stuff_images = "<div class=\"item-photos\">".$stuff_images."</div>";

        $query_material = "SELECT `value` FROM `modx_items_prop` WHERE `key` = 'Материал' AND `item_code_1c`='".$stuff_code_1c."' ";
        $result_material = getQuery($query_material, $path);
        $keywords = htmlspecialchars ($result[0]['keywords']);
        $description = htmlspecialchars ($result[0]['description']);
        $title = $result[0]['title'];
        if (!$title) $title = $result[0]['name'];
        $title = htmlspecialchars ($title);

        // TODO: Выполнить рефакторинг с использованием массива данных $props и $modx->setPlaceholders(array $props, $prefix);
        $modx->setPlaceholder("stuff_id", $stuff_code_1c);
        $modx->setPlaceholder("stuff_name", $result[0]['name']);
        $modx->setPlaceholder("stuff_h1", $result[0]['h1']);
        $modx->setPlaceholder("stuff_title", $title);
        $modx->setPlaceholder("stuff_description", $description);
        $modx->setPlaceholder("stuff_keywords", $keywords);

        $modx->setPlaceholder("imgalt_name", htmlspecialchars($result[0]['name']));
        $modx->setPlaceholder("stuff_brend", $brandlink);
        $modx->setPlaceholder("stuff_decor", $result[0]['decor']);
        $modx->setPlaceholder("stuff_content", $result[0]['content']);
        $modx->setPlaceholder("stuff_price", $result[0]['price_discount']);
        $modx->setPlaceholder("stuff_procent", $result[0]['discount_width']);
        $modx->setPlaceholder("stuff_material", $result_material[0]['value']);

        $modx->setPlaceholder("stuff_images", $stuff_images);
        $modx->setPlaceholder("b_image", $b_image);

        if (!isMobile()) {
            $zoomimg = '<table id="fixedblack"><tr><td><div class="hideimg"></div><img src="[[+url]]" id="im"></td></tr></table>';
            $modx->setPlaceholder("zoomimg", $zoomimg);
        }

        if ($result[0]['is_news']==1) $modx->setPlaceholder("is_news", 1);

        $modx->resource = $modx->getObject('modResource', 149); // Здесь подгружается ресурс с требуемым шаблоном
        $modx->resource->set("pagetitle", $result[0]['name']);
        $modx->request->prepareResponse();
    }
    return true;
}

return;
