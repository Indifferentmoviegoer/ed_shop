<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 03.10.2018
 * Time: 14:08
 */

namespace app\models;
use yii\base\Model;

class TestForm extends Model
{

    public $name;
    public $email;
    public $text;

    public function attributeLabels()
    {
        return [
            'name'=>'Имя',
            'email'=>'E-mail',
            'text'=>'Текст сообщения',
        ];
    }
    public function rules()
    {
        return [
            [['name','email'],'required'],
            ['email','email'],
//            ['name', 'string','min'=>2,'tooShort'=>'Malo'],
//            ['name', 'string','max'=>5,'tooLong'=>'Mnoga'],
            ['name','string', 'length'=>[2,5]],
            ['name','myRule'],
            ['text','trim'],
        ];
    }
    public function myRule($attr){
        if(!in_array($this->$attr,['hello','world'])){
            $this->addError($attr,'Wrong');
        }
    }
}