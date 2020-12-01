<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 13.10.2018
 * Time: 17:16
 */

namespace app\components;
use yii\base\Widget;

class SearchWidget extends Widget
{
    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content=ob_get_clean();
        $content=mb_strtoupper($content);
        return $this->render('search',compact('content'));
    }
}