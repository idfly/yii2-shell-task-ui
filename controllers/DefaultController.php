<?php

namespace idfly\shellTaskUi\controllers;

use Yii;
use idfly\shellTaskUi\models\LoginForm;
use yii\web\Controller;
use idfly\shellTask\ShellTask;

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

        foreach($tasks as &$task) {
            $task['info'] = ShellTask::getInfo($task['cmd']);
        }

        return $this->render('index', [
            'tasks' => $tasks,
        ]);
    }

    public function actionRunTask($cmd)
    {
        if($this->_checkIfTaskExists($cmd)) {
            ShellTask::run($cmd, []);
        }

        $this->redirect(['default/index']);
    }

    public function actionStopTask($cmd)
    {
        if($this->_checkIfTaskExists($cmd)) {
            ShellTask::stop($cmd);
        }

        $this->redirect(['default/index']);
    }

    protected function _checkIfTaskExists($cmd)
    {
        $tasks = \yii::$app->modules['shellTaskUi']->tasks;

        $isTaskExists =
            in_array($cmd, \yii\helpers\ArrayHelper::getColumn($tasks, 'cmd'));

        if($isTaskExists) {
            return true;
        }

        return false;
    }
}
