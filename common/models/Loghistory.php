<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "log_history".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $user_id
 * @property string $log_details
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 */
class Loghistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['company_id', 'user_id'], 'integer'],
//            [['log_details'], 'string'],
//            [['created_at', 'updated_at'], 'safe'],
//            [['created_by', 'updated_by'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
            'log_details' => 'Log Details',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function data($id){
        $connection = Yii::$app->db;
        $sql = "select company_id from user where id = $id";
        $execute = $connection->createCommand($sql);
        $data = $execute->queryOne();
        return $data;
    }
           
}
