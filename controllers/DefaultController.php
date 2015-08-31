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

    public function actionShowLog($command)
    {
        $tasks = \yii::$app->modules['shellTaskUi']->tasks;

        $taskForLog = null;

        foreach($tasks as $task) {
            if($task['command'] === $command) {
                $taskForLog = $task;
                break;
            }
        }

        $taskForLog['info'] = ShellTask::getInfo($task['command']);

        return $this->render('log', [
            'task' => $taskForLog,
        ]);
    }

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
            $task['info'] = ShellTask::getInfo($task['command']);
        }

        return $this->render('index', [
            'tasks' => $tasks,
        ]);
    }

    public function actionRunTask($command)
    {
        if($this->_checkIfTaskExists($command)) {
            ShellTask::run($command, []);
        }

        $this->redirect(['default/index']);
    }

    public function actionStopTask($command)
    {
        if($this->_checkIfTaskExists($command)) {
            ShellTask::stop($command);
        }

        $this->redirect(['default/index']);
    }

    protected function _checkIfTaskExists($command)
    {
        $tasks = \yii::$app->modules['shellTaskUi']->tasks;

        $isTaskExists =
            in_array($command,
                \yii\helpers\ArrayHelper::getColumn($tasks, 'command')
            );

        if($isTaskExists) {
            return true;
        }

        return false;
    }
}
