<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "login".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $password
 * @property string $passwordenc
 * @property string $username
 * @property string $mail
 * @property string $balance
 * @property string $picname
 * @property string $avatar
 * @property string $filename
 */
class ImageUploadForm extends ActiveRecord
{

    public $image;

    public static function tableName()
    {
        return 'login';
    }

    public function rules()
    {
        return [
            [['name', 'surname', 'passwordenc', 'username', 'mail'], 'string', 'max' => 128],
            [['picname', 'avatar' ], 'string', 'max' => 256],
            [['image'], 'file', 'extensions' => 'jpeg, jpg, png'],
            [['avatar', 'filename'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'password' => 'Password',
            'passwordenc' => 'Passwordenc',
            'username' => 'Username',
            'mail' => 'Mail',
            'balance' => 'Balance',
            'picname' => 'Picname',
            'avatar' => 'Avatar',
            'filename' => 'Filename',
        ];
    }

    public function getImageFile()
    {
        return isset($this->avatar) ? Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/uploads/' . $this->avatar : null;
    }

    public function getImageUrl()
    {
        $avatar = isset($this->avatar) ? $this->avatar : 'default_user.jpg';
        return Yii::$app->params['uploadUrl'] = Yii::$app->urlManager->baseUrl . '/uploads/' . $avatar;
    }

    public function uploadImage()
    {
        $image = UploadedFile::getInstance($this, 'image');
        if (empty($image)) {
            return false;
        }
        $this->filename = $image->name;
        $tmp = explode('.', $image->name);
        $ext = end($tmp);
        $this->avatar = Yii::$app->security->generateRandomString() . ".{$ext}";
        return $image;
    }

/*    public function uploadImage(){
        if ($this->validate()){
            $this->filename->saveAs('uploads/' . $this->filename->baseName. '.' . $this->filename->extension);
            $this->avatar = $this->filename;
            return true;
        } else {
            return false;
        }
    }*/

}
