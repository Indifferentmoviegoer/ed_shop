<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 09.10.2018
 * Time: 19:15
 */

namespace app\components;
use yii\base\Widget;

class MyWidget extends Widget
{
    public $name;
    public function init()
    {
        parent::init();
//        if($this->name===null) $this->name='Гость';
        ob_start();
    }

    public function run()
    {
        $content=ob_get_clean();
        $content=mb_strtoupper($content);
//        return $this->render('my',['name'=>$this->name]);
        return $this->render('my',compact('content'));
    }
}