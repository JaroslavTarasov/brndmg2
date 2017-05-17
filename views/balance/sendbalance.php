<?php

use yii\helpers\Html;
use yii\db\Query;
use app\models\Login;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use app\models\BalanceForm;

$users = Login::find()->where(['<>', 'id', Yii::$app->user->getId()])->all();
$items = \yii\helpers\ArrayHelper::map($users, 'username', 'username');
//$params = ['prompt' => 'Выберите имя'];
$this->title = 'Share';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-balance">

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="info">
            <h3><font color="red"><?php echo Yii::$app->session->getFlash('error'); ?></font></h3>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error1')): ?>
        <div class="info">
            <h3><font color="red"><?php echo Yii::$app->session->getFlash('error1'); ?></font></h3>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="info">
            <h3><font color="red"><?php echo Yii::$app->session->getFlash('success'); ?></font></h3>
        </div>
    <?php endif; ?>

    <h1><?= Html::encode('Укажите имя пользователя в системе и сумму перевода') ?></h1>

    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'form-balance']); ?>

        <div>
            <fieldset>
                <!--  $form->field($model, 'username')->textInput()  -->
                <?= $form->field($model, 'username')->dropDownList($items) ?>
                <?= $form->field($model, 'balance')->textInput() ?>
            </fieldset>
            <div class="form-group">
                <!-- Html::submitButton('Отправить!', ['class' => 'btn btn-primary', 'name' => 'inc-button']) -->
                <button type="submit" onclick="this.disabled = true; this.innerHTML='ВЫПОЛНЯЕТСЯ'">Отправить!</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>

</div>