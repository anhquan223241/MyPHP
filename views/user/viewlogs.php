<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Your logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'date',
            'checkin',
            'checkout',
        ],
    ]); ?>
</div>
