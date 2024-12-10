<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "login_status".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $login_time
 * @property string $logout_time
 * @property string $logout_reason
 * @property string $os_details
 * @property string $browserdetails
 * @property string $origination_IP
 * @property string $dob
 * @property string $session_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property User $user
 */
class LoginStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'login_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['logout_reason'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['login_time', 'logout_time', 'dob', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['os_details', 'browserdetails', 'origination_IP', 'session_id'], 'string', 'max' => 255]
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
            'login_time' => 'Login Time',
            'logout_time' => 'Logout Time',
            'logout_reason' => 'Logout Reason',
            'os_details' => 'Os Details',
            'browserdetails' => 'Browserdetails',
            'origination_IP' => 'Origination  Ip',
            'dob' => 'Dob',
            'session_id' => 'Session ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
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
