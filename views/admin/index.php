<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Staff', ['addstaff'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fullname',
            'username',
            //'password',
            'email:email',
            'role',
            'date_created',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{changerole}',
                'buttons' => [
                    'changerole' => function($url, $model, $key) {
                        return Html::a('Change Role', $url);
                    },
                ]],
            
        ],
    ]); ?>
</div>