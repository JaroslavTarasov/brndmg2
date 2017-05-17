<?php

namespace app\models;

use app\models\Login;
use Faker\Provider\DateTime;
use phpDocumentor\Reflection\Types\Null_;
use yii\base\Model;
use Yii;
use yii\base\UserException;
use yii\db\Exception;
use yii\web\Controller;


class BalanceForm extends Model
{
    public $balance;
    public $username;


    public function attributeLabels()
    {
        return [
            'balance' => 'Сумма',
            'username' => 'Кому отправить',
        ];
    }

    public function rules()
    {
        return [

            ['balance', 'number', 'min' => 0],
        ];
    }

    public function increase()
    {
        if ($this->validate()) {
            $bal = Login::findOne(Yii::$app->user->getId());
            if (empty($this->balance)) {
                Yii::$app->session->setFlash('error', "Вы не ввели сумму для отправки");
                return Yii::$app->response->redirect(\Yii::$app->urlManager->createUrl("balance/sendbalance"));
            }
            $bal->balance += $this->balance;
            $bal->save();
            return $bal;
        }
        return 0;
    }

    public function sendbal()
    {
        if ($this->validate()) {
            $desc = Login::findOne(Yii::$app->user->getId());
            if (empty($this->balance)) {
                Yii::$app->session->setFlash('error', "Вы не ввели сумму для отправки");
                return Yii::$app->response->redirect(\Yii::$app->urlManager->createUrl("balance/sendbalance"));
            } elseif ($desc->balance >= $this->balance) {
                $desc->balance -= $this->balance;
                $desc->save();
                $inc = Login::findOne(['username' => Yii::$app->request->post($this->username)]);
                $inc->balance += $this->balance;
                $inc->save();
                $log = new Logs();
                $log->howmuch = $this->balance;
                $log->who = $desc->username;
                $log->towhom = $inc->username;
                $log->date = new \yii\db\Expression('NOW()');
                $log->save();
            } else {
                Yii::$app->session->setFlash('error1', "Вы пытаетесь отправить больше, чем имеете");
                return Yii::$app->response->redirect(\Yii::$app->urlManager->createUrl("balance/sendbalance"));
            }
            Yii::$app->session->setFlash('success', "Сумма отправлена!");
            return $desc && $inc && $log;
        }
        return 0;
    }
}