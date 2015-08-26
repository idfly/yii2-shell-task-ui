<?php

namespace idfly\shellTaskUi\models;

use yii\base\Model;

class LoginForm extends Model
{
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public function beforeValidate()
    {
        $login = null;
        if(isset(\Yii::$app->controller->module->params['login'])) {
            $login = \Yii::$app->controller->module->params['login'];
        }

        $password = null;
        if(isset(\Yii::$app->controller->module->params['password'])) {
            $password = \Yii::$app->controller->module->params['password'];
        }

        if(($this->login == $login) && ($this->password == $password)) {
            $identity = new User();
            \Yii::$app->shellTaskUiUser->login($identity);
        } else {
            return false;
        }

        return parent::beforeValidate();
    }
}
