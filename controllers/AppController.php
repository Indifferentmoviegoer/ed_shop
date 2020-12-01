<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 02.10.2018
 * Time: 19:32
 */

namespace app\controllers;

use yii\web\Controller;
class AppController extends Controller
{
    protected function setMeta($title=null, $keywords=null, $description=null){
        $this->view->title=$title;
        $this->view->registerMetaTag(['name'=>'keywords', 'content'=>"$keywords"]);
        $this->view->registerMetaTag(['name'=>'description', 'content'=>"$description"]);
    }
    public function debug($arr){
        echo '<pre>'.print_r($arr,true).'</pre>';
    }
}