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

4. Добавить модуль в проектный конфиг:

        `$config['modules']['shellTaskUi'] = [
            'class' => 'idfly\shellTaskUi\Module',
            'params' => [
                'login' => 'root', // имя пользователя
                'password' => '123123', // пароль для доступа к странице модуля
            ],
            'tasks' => [
                [
                    'name' => 'Обновление похожих товаров',
                    'description' => 'Сделать обновление похожих товаров',
                    'cmd' => 'wares/update-similar',
                ],
            ],
        ];`

4. Перечислить свои команды в конфиге модуля в массиве `tasks`.

### Описание

Фронтенд для модуля `"idfly/yii2-shell-task-ui"`. Позволяет через интерфейс
запускать и останавливать задачи, а также смотреть логи работы команд.

### Использование

После установки зайти на страницу `http://your-site-domain/shellTaskUi`,
залогиниться по указанным в конфиге данным. После авторизации откроется
страница со списком команд.
