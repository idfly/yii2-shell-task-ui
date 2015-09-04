# yii2-shell-task-ui

Front-end module yii2-shell-task for launching yii2 console-commands.

### Description

Frontend for module `"idfly/yii2-shell-task"`. Allows start and stop the 
tasks through the interface and also see the command work logs.

## Set

1. To the project file `composer.json` add to the `require` section:

      `"idfly/yii2-shell-task-ui": "dev-master"`

2. To the `repositories` section:
      ```
      {
           "type": "git",
           "url": "git@bitbucket.org:idfly/yii2-shell-task-ui.git"
      }
      ```

3. Run `composer update`

## Setting

1. Add a module to the project's configuration list:

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
                    'name' => 'Updating similar wares',
                    'description' => 'Made an update of the similar wares',
                    'command' => 'wares/update-similar',
                ],
            ],
        ];`

2. List the commands in the module configuration list in an array `tasks`. 

3. In a route configuration file set user-friendly route for module:

        '/admin/shell-task-ui' => 'shellTaskUi/default/index',

### Usage

After installation go to the page `http://your-site-domain/shellTaskUi`, log 
in with data from configuration file. After authorization opens the page with
 command list.
