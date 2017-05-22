<?php

namespace app\controllers;

use Yii;
use app\models\Login;
use app\models\ImageUploadForm;
use yii\base\UserException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\BalanceForm;
use yii\web\UploadedFile;


class LoginController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['update', 'view', 'index'],
                'rules' => [
                    [
                        'actions' => ['update', 'view', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Login::find()->where(['id' => Yii::$app->user->getId()]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView()
    {
        $id = Yii::$app->user->getId();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Login();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

        public function actionUpdate()
        {
            $id = Yii::$app->user->getId();
            $model = $this->findModel($id);
            $oldFile = $model->getImageFile();
            $oldAvatar = $model->avatar;
            $oldFileName = $model->filename;

            if ($model->load(Yii::$app->request->post())) {
                $image = $model->uploadImage();

                if ($image === false) {
                    $model->avatar = $oldAvatar;
                    $model->filename = $oldFileName;
                }

                if ($model->save()) {

                    if ($image !== false && unlink($oldFile)) {
                        $path = $model->getImageFile();
                        $image->saveAs($path);
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    throw new UserException('Spoiled');
                }
            }
            return $this->render('update', [
                'model'=>$model,
            ]);
        }

/*    public function actionUpdate()
    {
        $id = Yii::$app->user->getId();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->filename = UploadedFile::getInstance($model, 'filename');
            $model->avatar = $model->filename;
            if ($model->uploadImage()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected
    function findModel()
    {
        $id = Yii::$app->user->getId();
        if (($model = ImageUploadForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
