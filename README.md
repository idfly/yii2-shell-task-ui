# yii2-shell-task-ui

Frontend-модуль yii2-shell-task для запуска команд yii2.

## Установка

1. В проектный `composer.json` добавить в секцию `require`:

        "idfly/yii2-shell-task-ui": "dev-master",

2. В секцию `repositories`:

        {
            "type": "git",
            "url": "git@bitbucket.org:idfly/yii2-shell-task-ui.git"
        }

3. Выполнить `composer update`

## Настройка

1. Добавить модуль в проектный конфиг:

        `$config['modules']['shellTaskUi'] = [
            'class' => 'idfly\shellTaskUi\Module',
            'params' => [
                'authorization_callback' => function() {
                    $admin = \app\models\Admin::getCurrent();
                    if(empty($admin)) {
                        Yii::$app->getResponse()->redirect('/admin/login');
                    }
                },
                'layout' => '@app/admin/views/layouts/admin.php'
            ],
            'tasks' => [
                [
                    'name' => 'Обновление похожих товаров',
                    'description' => 'Сделать обновление похожих товаров',
                    'command' => 'wares/update-similar',
                ],
            ],
        ];`

2. Перечислить свои команды в конфиге модуля в массиве `tasks`.

3. В route-конфиге указать удобочитаемый route для модуля

        '/admin/shell-task-ui' => 'shellTaskUi/default/index',

### Описание

Фронтенд для модуля `"idfly/yii2-shell-task"`. Позволяет через интерфейс
запускать и останавливать задачи, а также смотреть логи работы команд.

### Использование

После установки зайти на страницу `http://your-site-domain/shellTaskUi`,
залогиниться по указанным в конфиге данным. После авторизации откроется
страница со списком команд.
