<?php

namespace idfly\shellTaskUi\controllers;

use Yii;
use idfly\shellTaskUi\models\LoginForm;
use yii\web\Controller;

class DefaultController extends Controller
{
    public $enableCsrfValidation = false;

    public $layout = 'main';

    public function actionLogin()
    {
        if(!Yii::$app->cpatrackerUser->getIsGuest()) {
            $this->redirect(['index']);
        }

        $model = new LoginForm();

        if(Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if($model->validate()) {
                $this->redirect(['index']);
            }
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionIndex()
    {
        if(Yii::$app->cpatrackerUser->getIsGuest()) {
            $this->redirect(['login']);
        }

        $tasks = \yii::$app->modules['shellTaskUi']->tasks;

        return $this->render('index', [
            'tasks' => $tasks,
        ]);
    }
}
