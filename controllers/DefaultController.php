<?php

namespace idfly\shellTaskUi\controllers;

use Yii;
use yii\web\Controller;
use idfly\shellTask\ShellTask;

class DefaultController extends Controller
{
    public $defaultAction = '';
    public $enableCsrfValidation = false;

    public function beforeAction($action) {
        $this->layout = \Yii::$app->controller->module->params['layout'];
        \Yii::$app->controller->module->params['authorization_callback']();
        return parent::beforeAction($action);
    }

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

    public function actionIndex()
    {
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
