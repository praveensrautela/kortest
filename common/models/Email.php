<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "email".
 *
 * @property integer $id
 * @property string $from
 * @property string $to
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 */
class Email extends \yii\db\ActiveRecord {

  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'email';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
	[['created_at', 'updated_at', 'status', 'type'], 'safe'],
	[['send_from', 'send_to'], 'string', 'max' => 255],
	[['updated_by'], 'string', 'max' => 100]
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
	'id' => 'ID',
	'send_from' => 'Email From',
	'send_to' => 'Email To',
	'body' => 'Email Body',
	'status' => 'Status',
	'created_at' => 'Created At',
	'updated_at' => 'Updated At',
	'updated_by' => 'Updated By',
    ];
  }
    public function getUserEmail($id){
      if(isset($id)){
      $user_email = UserEmail::findOne(['user_id' => $id]);
          $email = $user_email['primary_email'];
      }
      return $email;
}
  public function getInboxData($useremail){
    $query = (new Query())
                ->from('email')
                ->where(['send_to' => $useremail])
                ->andWhere(['type' => 'email']);
        $command = $query->createCommand();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => count($query->all()),
        ]);
        $count = count($query->all());
        
        $data1 = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
                return $data1;
  }
  public function advisorprimaryemail($user_id){
      
             $connection = Yii::$app->getDb();
              $sql="SELECT um.primary_email,am.email1 FROM user_email um 
LEFT JOIN user_advisory_map uam ON uam.user_id=um.user_id AND is_active=1
LEFT JOIN advisor_master am ON am.id=uam.advisor_id 
WHERE um.user_id=$user_id ORDER BY um.id DESC LIMIT 1 ";
            $command = $connection->createCommand($sql);
            $data = $command->queryOne();
            return $data;
     }

}
