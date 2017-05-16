<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Редактировать личные данные';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            'name',
            'surname',
            'username',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',],
        ],
    ]); ?>
</div>
