<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checkin".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date_checkin
 * @property string $time_checkin
 * @property string $date_modified
 *
 * @property User $user
 */
class Checkin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'date_checkin', 'time_checkin'], 'required'],
            [['user_id'], 'integer'],
            [['date_checkin', 'time_checkin', 'date_modified'], 'safe'],
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
            'date_checkin' => 'Date Checkin',
            'time_checkin' => 'Time Checkin',
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
