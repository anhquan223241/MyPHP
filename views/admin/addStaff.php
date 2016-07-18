<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form ActiveForm */

$this->title = 'Create Staff';
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-addstaff">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'fullname')->textInput() ?>
        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'role')->dropDownList(
                ['staff' => 'Staff', 'admin' => 'Admin'],
                ['prompt' => 'Select Role']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- admin-addstaff -->
