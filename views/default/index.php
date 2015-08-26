<?php
use yii\helpers\Html;
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th></th>
            <th>Название</th>
            <th>Описание</th>
            <th>Команда</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($tasks as $index => $task) : ?>
            <tr>
                <th scope="row">#<?= ++$index ?></th>
                <td><?= Html::encode($task['name']) ?></th>
                <td><?= Html::encode($task['description']) ?></td>
                <td><?= Html::encode($task['cmd']) ?></td>
                <td>todo</td>
                <td>todo</td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
