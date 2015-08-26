<?php

namespace idfly\shellTaskUi;

class Module extends \yii\base\Module
{
    public $tasks;

    public $controllerNamespace = 'idfly\shellTaskUi\controllers';

    public function init()
    {
        parent::init();

        \Yii::$app->set('shellTaskUiUser', [
            'identityClass' => 'shellTaskUi\models\User',
            'class' => 'yii\web\User',
            'enableAutoLogin' => true,
        ]);
    }
}
