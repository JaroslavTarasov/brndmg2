<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список переводов';

?>
<?php if(Yii::$app->session->hasFlash('success')):?>
    <div class="info">
        <h3><font color="red"><?php echo Yii::$app->session->getFlash('success'); ?></font> </h3>
    </div>
<?php endif; ?>
<div class="logs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
            'who',
            'towhom',
            'howmuch',
            'date',
        ],
    ]); ?>

</div>
