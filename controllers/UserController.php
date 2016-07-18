<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\User;
use app\models\Checkin;
use app\models\Checkout;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;

class UserController extends \yii\web\Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/user/login');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/user/viewlogs');
            //return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionViewlogs() {
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM checkin where user_id=:user_id', [':user_id' => Yii::$app->user->getId()])->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT  ci.date_checkin as date, time_checkin as checkin, time_checkout as checkout'
            . ' FROM checkin ci left outer join checkout co'
            . ' on ci.date_checkin = co.date_checkout'
            . ' and ci.user_id = co.user_id'
            . ' where ci.user_id=:user_id',
            'params' => [':user_id' => Yii::$app->user->getId()],
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['date'],
                'defaultOrder' => ['date' => SORT_DESC],
            ],
        ]);
        return $this->render('viewlogs', ['dataProvider' => $dataProvider]);
    }

    public function actionCheckin() {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $checkin = new Checkin();
        if (!$checkin->find()->where(['user_id' => Yii::$app->user->getId(), 'date_checkin' => date('Y-m-d')])->one()) {

            $checkin->user_id = Yii::$app->user->getId();
            $checkin->date_checkin = date('Y-m-d');
            $checkin->time_checkin = date('H:i:s');
            $checkin->save();
            $this->redirect('viewlogs');
        } else {
            echo 'You have already checkin today';
        }
    }

    public function actionCheckout() {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $checkout = new Checkout();
        if (!$checkout->find()->where(['user_id' => Yii::$app->user->getId(), 'date_checkout' => date('Y-m-d')])->one()) {

            $checkout->user_id = Yii::$app->user->getId();
            $checkout->date_checkout = date('Y-m-d');
            $checkout->time_checkout = date('H:i:s');
            $checkout->save();
            $this->redirect('viewlogs');
        } else {
            echo 'You have already checkout today';
        }
    }

}
