<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property integer $operation
 * @property string $who
 * @property string $towhom
 * @property string $howmuch
 * @property string $date
 */
class Logs extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'logs';
    }

    public function rules()
    {
        return [
            [['howmuch'], 'number'],
            [['date'], 'safe'],
            [['who', 'towhom'], 'string', 'max' => 128],
        ];
    }

    public function attributeLabels()
    {
        return [
            'operation' => 'Operation',
            'who' => 'Отправитель',
            'towhom' => 'Кому',
            'howmuch' => 'Сумма перевода',
            'date' => 'Точное время перевода',
        ];
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }
}
