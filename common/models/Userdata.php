<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $date_of_birth
 * @property string $password_hash
 * @property integer $is_active
 * @property integer $otp
 * @property integer $is_admin
 * @property string $created_at
 */
class Userdata extends \yii\db\ActiveRecord
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
            [['is_active', 'user_access_id'], 'integer'],
            [['created_at'], 'safe'],
            [['username', 'mobile'], 'string', 'max' => 50],
            [['email', 'date_of_birth', 'password_hash'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'date_of_birth' => 'Date Of Birth',
            'password_hash' => 'Password Hash',
            'is_active' => 'Is Active',
            'otp' => 'Otp',
            'is_admin' => 'Is Admin',
            'created_at' => 'Created At',
        ];
    }
}
