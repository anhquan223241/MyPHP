<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form ActiveForm */
?>
<div class="admin-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'fullname')->textInput() ?>
        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'role')->dropDownList(
                ['Staff', 'Admin'],
                ['prompt' => 'Select Role']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- admin-index -->
