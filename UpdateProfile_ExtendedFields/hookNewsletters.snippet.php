<?php
 /**
 * Created by PhpStorm.
 * Author:   ershov-ilya
 * GitHub:   https://github.com/ershov-ilya/
 * Website:  http://ershov.pw/ (RU/ENG)
 * Date: 25.02.2016
 * Time: 16:09
 */

$receive_news = $hook->getValue('get_news_by_email');
$receive_news_when = $hook->getValue('get_news_when');
$user = $hook->getValue('updateprofile.user');
$email = $hook->getValue('email');
$name = $hook->getValue('fullname');
$user_id = $user->get('id');
$subscriber = $modx->getObject('vnewsSubscribers', array('email' => $email));

if (!$subscriber)
{
    $subscriber = $modx->newObject('vnewsSubscribers');
    $params = array(
        'user_id' => $user_id,
        'email' => $email,
        'name' => $name,
        'is_active' => 1,
        'hash' =>str_rot13(base64_encode(hash('sha512', time() . $email)))
    );
    $subscriber->fromArray($params);
    if ($subscriber->save() === FALSE) {
        $this->modx->setDebug();
        $this->modx->log(modX::LOG_LEVEL_ERROR, 'Failed to save a new subscriber! ' . print_r($params, TRUE), '', __METHOD__, __FILE__, __LINE__);
        $this->modx->setDebug(FALSE);
        continue;
    }

    switch ($receive_news_when)
    {
        case 'Ежедневно':
            $cat_name = 'News daily';
            break;
        case 'Раз в неделю':
            $cat_name = 'News weekly';
            break;
        case 'Никогда':
            $cat_name = 'News never';
            break;
        case 'Дважды в неделю':
            $cat_name = 'News twice a week';
            break;
        case 'Раз в месяц':
            $cat_name = 'News monthly';
            break;
        default:
            $cat_name = 'News';
            break;
    }

    $categoryObj = $modx->getObjectGraph('vnewsCategories'
        , array('vnewsSubscribersHasCategories' => array())
        , array(
            'name' => $cat_name
        )
    );
    if ($categoryObj) {
        $subscribersHasCategories = $modx->newObject('vnewsSubscribersHasCategories');
        $addManyParams = array(
            'subscriber_id' => $subscriber->getPrimaryKey(),
            'category_id' => $categoryObj->get('id')
        );
        $subscribersHasCategories->fromArray($addManyParams, '', TRUE, TRUE);
        $addMany = array($subscribersHasCategories);
        $subscriber->addMany($addMany);
        if ($subscriber->save() === FALSE) {
            $this->modx->setDebug();
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Failed to add subscriber to category! ' . print_r($addManyParams, TRUE), '', __METHOD__, __FILE__, __LINE__);
            $this->modx->setDebug(FALSE);
            continue;
        }
    }
}

if ($receive_news == 'Y')
{
    $user->joinGroup(3);
    $subscriber->set('is_active', 1);
    $subscriber->save();
}
else
{
    $user->leaveGroup(3);
    $subscriber->set('is_active', 0);
    $subscriber->save();
}

return true;
