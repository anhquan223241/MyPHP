<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $fullname
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $role
 * @property string $date_created
 *
 * @property Checkin[] $checkins
 * @property Checkout[] $checkouts
 * @property LogHistory[] $logHistories
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname', 'username', 'password', 'email', 'role', 'date_created'], 'required'],
            [['date_created'], 'safe'],
            [['fullname', 'username'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 100],
            [['role'], 'string', 'max' => 5],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Fullname',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'role' => 'Role',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckins()
    {
        return $this->hasMany(Checkin::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckouts()
    {
        return $this->hasMany(Checkout::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogHistories()
    {
        return $this->hasMany(LogHistory::className(), ['user_id' => 'id']);
    }
}
