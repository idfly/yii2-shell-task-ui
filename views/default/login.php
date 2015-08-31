<?php $form = \yii\widgets\ActiveForm::begin([
    'options' => ['class' => '',],
]); ?>

<?= $form->field($model, 'login')->textInput() ?>
<?= $form->field($model, 'password')->passwordInput() ?>

<?= \yii\helpers\Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>

<?php \yii\widgets\ActiveForm::end(); ?>
