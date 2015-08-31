<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th></th>
            <th>Название</th>
            <th>Описание</th>
            <th>Команда</th>
            <th>Статус</th>
            <th>Лог</th>
            <th>Действия</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($tasks as $index => $task) : ?>
            <tr
                <?php if(!empty($task['info']['processes_count'])) : ?>
                    class="info"
                <?php elseif($task['info']['status_code'] !== "0") : ?>
                    class="danger"
                <?php endif ?>
            >
                <th scope="row">#<?= ++$index ?></th>
                <td><?= Html::encode($task['name']) ?></th>
                <td><?= Html::encode($task['description']) ?></td>
                <td><?= Html::encode($task['command']) ?></td>
                <td>
                <?php if(!empty($task['info'])) : ?>
                    <?php if(!empty($task['info']['processes_count'])) : ?>
                        Выполняется процессов в данный момент:
                        <?= $task['info']['processes_count'] ?>
                    <?php else : ?>
                        Дата последнего выполнения<br/>
                        <?= Html::encode(explode('.', $task['info']['last_modify_date'])[0]) ?> <br/>
                        exit-код: <?= Html::encode($task['info']['status_code']) ?>,
                        <?php if($task['info']['status_code'] === "0") : ?>
                            команда выполнена успешно
                        <?php else : ?>
                            ошибка выполения команды
                        <?php endif ?>
                    <?php endif ?>
                <?php endif ?>
                </td>
                <td>
                <?php if(!empty($task['info']['log'])) : ?>
                    <a href="#log<?= Html::encode($index) ?>" class="btn btn-default" data-toggle="collapse">Посмотреть лог</a>
                    <div id="log<?= Html::encode($index) ?>" class="collapse">
                        <?= Html::encode($task['info']['log']) ?>
                    </div>
                <?php endif ?>
                </td>
                <td>
                    <?php if(!empty($task['info']['processes_count'])) : ?>
                        <a class="btn btn-xs btn-danger inline glyphicon glyphicon-stop"
                            href="<?= Url::to(['/shellTaskUi/default/stop-task', 'command' => $task['command']]) ?>"></a>
                    <?php else : ?>
                        <a class="btn btn-xs btn-primary inline glyphicon glyphicon-play"
                            href="<?= Url::to(['/shellTaskUi/default/run-task', 'command' => $task['command']]) ?>"></a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
