<?php

namespace app\controllers;

use Yii;
use app\models\Staff;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class AdminController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->role;
                        },
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Staff::find(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAddstaff()
    {
        $model = new Staff();
        $model->date_created = date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('addStaff', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionChangerole($id)
    {
        $model = $this->findModel($id);
        $role = $model->role;
        if($role === 'staff') {
            $model->role = 'admin';
        } else {
            $model->role = 'staff';
        }
        $model->save();
        return $this->redirect('index');
        
    }
    
    protected function findModel($id)
    {
        if (($model = Staff::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
