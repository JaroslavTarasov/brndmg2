<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ImageUploadForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImageUploadForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="login-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <hr>
    <div class="img-thumbnail">
        <?php $title = isset($model->filename) && !empty($model->filename) ? $model->filename : 'Изображение';
        echo Html::img($model->getImageUrl(), ['class' => 'img-thumbnail', 'alt' => $title, 'title' => $title]) ?>
    </div>
    <hr>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Загрузить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
