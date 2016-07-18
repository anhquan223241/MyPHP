<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checkout".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date_checkout
 * @property string $time_checkout
 * @property string $date_modified
 *
 * @property User $user
 */
class Checkout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'date_checkout', 'time_checkout'], 'required'],
            [['user_id'], 'integer'],
            [['date_checkout', 'time_checkout', 'date_modified'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'date_checkout' => 'Date Checkout',
            'time_checkout' => 'Time Checkout',
            'date_modified' => 'Date Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
