<?php

namespace app\models;

use app\models\Login;
use yii\base\Model;
use Yii;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $mail;

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'mail' => 'E-mail',
        ];
    }

    public function rules()
    {
        return [
            [['username'], 'string', 'max' => 128],
            ['username', 'unique', 'targetClass' => '\app\models\Login', 'message' => 'Username exists already. Try another'],
            [['password'], 'string', 'max' => 16],

            [['mail'], 'email'],
            ['mail', 'filter', 'filter' => 'trim'],
            ['mail', 'unique', 'targetClass' => '\app\models\Login', 'message' => 'Mail exists already. Try another'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new Login();
            $user->username = $this->username;
            $user->mail = $this->mail;
            $user->setPassword($this->password);
            $user->save();

            return $user;
        }
        return 0;
    }
}