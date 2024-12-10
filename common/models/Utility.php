<?php

namespace common\models;

use yii\web\S3;
use Yii;
use yii\base\Model;
use yii\helpers\Security;
use common\models\Email;
use common\models\User;
use common\models\Userplans;
use common\models\TokenMaster;
use common\models\Dashboard;
use \common\helpers\Common;
use common\models\Wealthsimpleuser;
use common\models\Payments;

//$path = Yii::getAlias("@vendor/swiftmailer/swiftmailer/lib/classes/Swift/AWSTransport.php");
//    require_once($path);

class Utility extends Model {

    public static $isSuccess = "success";
    public static $status_code = 200;
    public static $errorMessage = "";

    public function fn_url($title) {
        $str = preg_replace('/[^a-zA-Z0-9-]/', '-', trim($title));
        if (!empty($title)) {
            $str = strtolower($str);
        }
        $str = preg_replace('/[-]+/', '-', $str);
        return $str;
    }

    public function fn_urlid($id, $title, $tag = "") {
        $str = preg_replace('/[^a-zA-Z0-9-]/', '-', ltrim(rtrim($title)));
        $str = preg_replace('/[-]+/', '-', $str);
        if (empty($tag)) {
            $str = strtolower($str) . '-' . $id;
        } else {
            $str = strtolower($str) . '-' . $tag . '-' . $id;
        }
        $str = preg_replace('/[-]+/', '-', $str);

        return $str;
    }

    public function file_get_content($url, $request_type = 'curl', $params = array()) {

        try {
//$request_type = 'native';
            if ($request_type == 'curl') {
// create curl resource
                $ch = curl_init();
// set url
                curl_setopt($ch, CURLOPT_URL, $url);
//return the transfer as a string
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 50);
// $res contains the output string
                $res = curl_exec($ch);
// close curl resource to free up system resources
                curl_close($ch);
            } else {
//echo $url . "<br/>";
                $res = @file_get_contents($url);
            }
            return $res;
        } catch (Exception $e) {
//print_r($e);
        }
    }

    function LocalReadFile($path) {
        $data = @$this->file_get_content($path, 'local');
        return $data;
    }

    public function getImage($id) {
        $connection = \Yii::$app->db;
        $sql = "select * from file where file_id=:id";
        $imageData = $connection->createCommand($sql)->bindValue(":id", $id)->queryAll();
        $fullimage = '';
        foreach ($imageData as $image) {
            $fullimage = CDN_URL . $image['file_url'] . $image['file_ext'];
        }
        return $fullimage;
    }

   

    /*     * ******************************************************************************************** */

    

    public function UploadPDF($pdffile, $bucket) {
        ini_set('upload_max_filesize', '64M');
        set_time_limit(0);
        $bucketUrl = STATIC_S3_URL . '/' . $bucket . '/';
        $s3 = new S3(AWS_ACCESS_KEY, AWS_SECRET_KEY);
        if (!empty($pdffile)) {
            $sourcePath = PDF_URL . $pdffile;
            $s3->putObjectFile($sourcePath, $bucketUrl, $bucket . '/' . $pdffile, S3::ACL_PUBLIC_READ_WRITE);

//            echo $pdffile;
        }
    }

    public function UploadCSV($csvfile, $bucket) {
        ini_set('upload_max_filesize', '64M');
        set_time_limit(0);
        $bucketUrl = STATIC_S3_URL . '/' . $bucket . '/';
        $s3 = new S3(AWS_ACCESS_KEY, AWS_SECRET_KEY);
        if (!empty($csvfile)) {
            $sourcePath = PDF_URL . $csvfile;
            $s3->putObjectFile($sourcePath, $bucketUrl, $bucket . '/' . $csvfile, S3::ACL_PUBLIC_READ_WRITE);
        }
    }

    public function UploadDoc($pdffile, $bucket) {
        ini_set('upload_max_filesize', '64M');
        set_time_limit(0);
        $bucketUrl = STATIC_S3_URL . '/' . $bucket . '/';
        $s3 = new S3(AWS_ACCESS_KEY, AWS_SECRET_KEY);
        if (!empty($pdffile)) {
            $sourcePath = UPLOAD_TEMP_FILE_PATH . $pdffile;
            $s3->putObjectFile($sourcePath, $bucketUrl, $bucket . '/' . $pdffile, S3::ACL_PUBLIC_READ_WRITE);
//            echo $pdffile;
        }
    }

    public function UploadZip($zipfile, $bucket) {
        ini_set('upload_max_filesize', '64M');
        set_time_limit(0);
        $bucketUrl = STATIC_S3_URL . $bucket;
        $s3 = new S3(AWS_ACCESS_KEY, AWS_SECRET_KEY);
        if (!empty($pdffile)) {
            $sourcePath = PDF_URL . $pdffile;
            $s3->putObjectFile($sourcePath, $bucketUrl, $bucket . $pdffile, S3::ACL_PUBLIC_READ_WRITE);
//            echo $pdffile;
        }
    }

    public function getfundHouse($pid) {
        $connection = \Yii::$app->db;
        $sql = '';
        $sql .= "select id,name from fund_house";
        if (!empty($pid)) {
            $sql .= " where pid=:pid";
        }
        $sql .= " order by name ASC";
        $data = $connection->createCommand($sql)
                ->bindValue(":pid", $pid)
                ->queryAll();
        return $data;
    }

    public function getfundScheme($fid, $term) {
        $connection = \Yii::$app->db;
        $sql = '';
        $sql .= "select id,name as value from fund_scheme";
        if (!empty($fid)) {
            $sql .= " where fund_house_id=:fid";
        }

        if (!empty($fid)) {
            $sql .= " and name like '%" . $term . "%'";
        }
        $data = $connection->createCommand($sql)
                ->bindValue(":fid", $fid)
                ->queryAll();
        return $data;
    }

    public function OTP() {
        $random = "";
        for ($i = 0; $i < 4; $i++) {
            $random .= mt_rand(1, 9);
        }
        return $random;
    }

    public function ExpireTime() {
        $cur_time = date("Y-m-d H:i:s");

        $duration = '+2 hours';
        return date('Y-m-d H:i:s', strtotime($duration, strtotime($cur_time)));
    }

    public function ExpireMinutesTime() {
        date_default_timezone_set('Asia/Calcutta');
        $cur_time = date("Y-m-d H:i:s");
        $duration = '+30 minutes';
        return date('Y-m-d H:i:s', strtotime($duration, strtotime($cur_time)));
    }

    public function dateFormating($date) {
        $dt = strtotime($date);
        $dt = $dt + 19800;
        $dt = gmdate('F d, Y', $dt);
        return $dt;
    }

    public function sendemail($body, $email, $subject) {
        return Yii::$app->mailer->compose()
                        ->setTo($email)
                        ->setFrom('support@pmsaifclub.com')
                        ->setSubject($subject)
                        ->setHtmlBody($body)
                        ->send();
    }

    public function sendemailnoreply($body, $email, $subject) {
        return Yii::$app->mailer->compose()
                        ->setTo($email)
                        ->setFrom(['no-reply@pmsaifclub.com' => 'pmsaif Support'])
                        ->setSubject($subject)
                        ->setHtmlBody($body)
                        ->send();
    }

    public function encrypt($plaintext) {
        $key = pack('H*', Yii::$app->params['encryptKey']);
//        $key_size = strlen($key);
//
//        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
//        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
//        $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $plaintext, MCRYPT_MODE_CBC, $iv);
//        $ciphertext = $iv . $ciphertext;
//
//        $ciphertext_base64 = base64_encode($ciphertext);

        $encrypt = trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $plaintext, MCRYPT_MODE_ECB, mcrypt_create_iv(
                                        mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));

        return $encrypt;
    }

    public function decrypt($encrypt) {
        $key = pack('H*', Yii::$app->params['encryptKey']);
//        $key_size = strlen($key);
//
//        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
//
//        $ciphertext_dec = base64_decode($ciphertext_base64);
//        $iv_dec = substr($ciphertext_dec, 0, $iv_size);
//        $ciphertext_dec = substr($ciphertext_dec, $iv_size);
//        $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
//
//        return $plaintext_dec;

        $decrypt = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($encrypt), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(
                                        MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));

        return $decrypt;
    }

    public function encrypString($plaintext) {
        # --- ENCRYPTION ---

        $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3"); //change this
        # show key size use either 16, 24 or 32 byte keys for AES-128, 192
        # and 256 respectively
        $key_size = strlen($key);
        //echo "Key size: " . $key_size . "\n";
        # create a random IV to use with CBC encoding
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);

        # creates a cipher text compatible with AES (Rijndael block size = 128)
        # to keep the text confidential
        # only suitable for encoded input that never ends with value 00h
        # (because of default zero padding)
        $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $plaintext, MCRYPT_MODE_CBC, $iv);

        # prepend the IV for it to be available for decryption
        $ciphertext = $iv . $ciphertext;

        # encode the resulting cipher text so it can be represented by a string
        $ciphertext_base64 = base64_encode($ciphertext);

        return rawurlencode($ciphertext_base64); //important rawurlencode for + symbol in url
    }

    public function decryptString($ciphertext_base64) {
        # --- DECRYPTION ---

        $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3"); //change this
        # show key size use either 16, 24 or 32 byte keys for AES-128, 192
        # and 256 respectively
        $key_size = strlen($key);
        //echo "Key size: " . $key_size . "\n";
        # create a random IV to use with CBC encoding
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);

        $ciphertext_dec = base64_decode($ciphertext_base64);

        # retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
        $iv_dec = substr($ciphertext_dec, 0, $iv_size);

        # retrieves the cipher text (everything except the $iv_size in the front)
        $ciphertext_dec = substr($ciphertext_dec, $iv_size);

        # may remove 00h valued characters from end of plain text
        $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);

        return rawurldecode($plaintext_dec);
    }

//       encryption and descryption
//        FOR DOB , AADHAR ,ACCOUNT NUMBER , Pan Number
//        for encryption

    public function encryptionFormat($value) {
        $security = new Security();
        $encryption = base64_encode($security->encrypt($value, BASE_SECURITY));
        return $encryption;
    }

    public function encryptionFormatforcookie($value) {
        $security = new Security();
        $encryption = $this->base64urlencryptcustom($security->encrypt($value, BASE_SECURITY));
        return $encryption;
    }

    /*
     * 
     * 
     * 
     *  
     */

    public function encryptValueUsingKey($value, $key) {
        $security = new Security();
        $encryption = base64_encode($security->encrypt($value, $key));
        return $encryption;
    }

    public function base64urlencryptcustom($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64urldecryptcustom($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

//    for descryption

    public function descriptionFormat($value) {
        if (!empty($value)) {
            if ($value == 'investors') {
                return '';
            } else if ($value == 'admin') {
                return '';
            } else if ($value == 'superadmin') {
                return '';
            }

            $security = new Security();
            $description = $security->decrypt(base64_decode($value), BASE_SECURITY);
            return $description;
        } else {
            return '';
        }
    }

    public function descriptionFormatforcookie($value) {
        if (!empty($value)) {
            if ($value == 'investors') {
                return '';
            } else if ($value == 'admin') {
                return '';
            } else if ($value == 'superadmin') {
                return '';
            }
            if (strlen($value) < 10) {
                return '';
            }
            $security = new Security();
            $description = $security->decrypt($this->base64urldecryptcustom($value), BASE_SECURITY);
            return $description;
        } else {
            return '';
        }
    }

    public function differenceDob($value) {
        if (!empty($value)) {
            $currentdate = date('d-m-Y');
            $diff = strtotime($currentdate) - strtotime($value);
            $days = $diff / 60 / 60 / 24;
            $age = $days / 365;
            return $age;
        } else {
            return '';
        }
    }

//  For transaction reference number

    public function transReference($id) {
        date_default_timezone_set('Asia/Calcutta');
        $current_day_year = "";
        $current_year = "";
        $trans_id = "";
        $ref_number = "";
        if (!empty($id)) {
            $current_day_year = date('z') + 1;
            $current_year = date("y");
            $trans_id = $id;
            $ref_number = "PR" . $current_day_year . $current_year . $trans_id;

            $connection = \Yii::$app->db;
            $sql = "UPDATE user_transaction SET refrence_id= :rnum WHERE id = :tid";
            $data = $connection->createCommand($sql)
                    ->bindValue(":tid", $trans_id)
                    ->bindValue(":rnum", $ref_number)
                    ->execute();
            return $data;
        }
    }

    public function transReferenceForReliance($id) {
        date_default_timezone_set('Asia/Calcutta');
        $current_day_year = "";
        $current_year = "";
        $trans_id = "";
        $ref_number = "";
        if (!empty($id)) {
            $current_day_year = date('z') + 1;
            $current_year = date("y");
            $trans_id = $id;
            $ref_number = "RR" . $current_day_year . $current_year . $trans_id;

            $connection = \Yii::$app->db;
            $sql = "UPDATE user_transaction SET refrence_id= :rnum WHERE id = :tid";
            $data = $connection->createCommand($sql)
                    ->bindValue(":tid", $trans_id)
                    ->bindValue(":rnum", $ref_number)
                    ->execute();
            return $data;
        }
    }

    public function ChangememberTemplate($name, $mobile_no = '', $email, $dob, $oldTemplate, $password = '') {

        $body = str_replace('${mobileNumber}', !empty($mobile_no) ? $mobile_no : "", $oldTemplate);
        $body = str_replace('${name}', !empty($name) ? $name : "", $body);
        $body = str_replace('${email}', !empty($email) ? $email : "", $body);
        $body = str_replace('${password}', !empty($password) ? $password : "", $body);
        $body = str_replace('${memdob}', !empty($dob) ? $dob : "", $body);
        $body = str_replace('${siteURL}', BASE_URL, $body);
        $body = str_replace('${cdnUrl}', CDN_URL, $body);
        $body = str_replace('${TnC}', BASE_URL . 'openterm/showtermsonmail?category=pmsaif', $body);
        // $body = str_replace('Name:', "", $body);
        return $body;
    }

    public function migratetransReference($dayofyear, $year, $id) {
//            date_default_timezone_set('Asia/Calcutta');
        $ref_number = "";
        if (!empty($id)) {

            $ref_number = "PR" . $dayofyear . $year . $id;

            $connection = \Yii::$app->db;
            $sql = "UPDATE user_transaction SET refrence_id= :rnum WHERE id = :tid";
            $data = $connection->createCommand($sql)
                    ->bindValue(":tid", $id)
                    ->bindValue(":rnum", $ref_number)
                    ->execute();
            return $data;
        }
    }

//for normal messages
    public function Message($name, $message) {
        $data = '{   
                    "' . $name . '":["' . $message . '"]
                    }';
        return json_decode($data);
    }

//for node messages
    public function geterrorMessage($value) {
        if (!empty($value)) {
            foreach ($value as $message) {
                $valueerror = $message[0];
            }
            return $valueerror;
        }
    }

//sample Token of for mobile
    public function generateencryptionToken($device_id, $user_id) {

        $utility = new Utility();
        if (!empty($device_id)) {
            $deviceid = $device_id;
        } else {
            $deviceid = '';
        }
        if (!empty($user_id)) {
            $userid = $user_id;
        }
        $tokenraw = $deviceid . "+" . $userid;
        $enctoken = $utility->encryptionFormat($tokenraw);
        return $enctoken;
    }

    public function generateencryptionapiToken($device_id, $user_id) {
        $utility = new Utility();
        $deviceidd = $utility->descriptionFormat($device_id);
        $expire_date = date("Y-m-d H:i:s", strtotime($GLOBALS['api_messages']['token']['expiry_date']));
        if (!empty($deviceidd)) {
            $deviceid = $deviceidd;
        } else {
            $deviceid = '';
        }
        if (!empty($user_id)) {
            $userid = $user_id;
        }
        //  $tokenraw = $deviceid . "+" . $userid . "$" . $expiry_date;        
        $tokenraw = $deviceid . "+" . $userid . "+" . $expire_date;
        $enctoken = $utility->encryptionFormat($tokenraw);
        return $enctoken;
    }

    public function varifyToken($tokenraw) {
        $utility = new Utility();
        $enctoken = $utility->descriptionFormat($tokenraw);
        $arraytoken = explode("+", $enctoken);
        $device_id = $arraytoken[0];
        $user_id = $arraytoken[1];
        $data = [
            'device_id' => $device_id,
            'user_id' => $user_id,
        ];
        return json_encode($data);
    }

    public function jsonresult($data) {
        if (!empty($data)) {
            return(json_encode($data, TRUE));
        } else {
            $data = [];
            return(json_encode($data, TRUE));
        }
    }

    /* added code for changed password */

    public function getsettingURL($user_id) {

        $logins = User::findIdentity($user_id);
        $passWordExpiry = $logins['password_expiry_date'];
        date_default_timezone_set('Asia/Calcutta');
        $curdatetime = date("Y-m-d H:i:s");

        if ($curdatetime > $passWordExpiry) {
            $this->redirect(BASE_URL . 'setting');
        }
    }

    public function getsettingVal($user_id) {

        $logins = User::findIdentity($user_id);
        $passWordExpiry = $logins['password_expiry_date'];
        date_default_timezone_set('Asia/Calcutta');
        $passCurrentExpiry = date("Y-m-d H:i:s");
        if ($passCurrentExpiry > $passWordExpiry) {
            $valSetting = 1;
            return $valSetting;
        } else {
            $valSetting = 2;
            return $valSetting;
        }
    }

    public function planUpdate($user_id, $user_name) {
        $connection = \Yii::$app->db;
        $userPlan = Userplans::find()->where('user_id=:user_id', [':user_id' => $user_id])->orderBy('id DESC')->limit(1)->one();
        if (empty($userPlan)) {
            $this->Saveuserplan($user_id, $user_name);
        } else {
            $userPlan = Userplans::find()->where('user_id=:user_id AND is_active=:is_active', [':user_id' => $user_id, ':is_active' => 1])->orderBy('id DESC')->limit(1)->one();
            $checkExpiry = Userplans::getDaysLeft($userPlan);
            if (!empty($userPlan)) {
                if ($checkExpiry['status'] === FALSE) {
                    $userPlan->is_active = 0;
                    $userPlan->save();
                }
            }
        }
    }

    public function Saveuserplan($user_id, $user_name) {
        $model = new Userplans();
        $model->user_id = $user_id;
        $model->plan_id = 1;
        $model->start_date = date('Y-m-d');
        $Date = date('Y-m-d');
        $plantrialday = plantrialday;
        $model->end_date = date('Y-m-d', strtotime($Date . ' + ' . $plantrialday));
        $model->created_by = $user_name;
        $model->save();
        $payment = new Payments();
        $payment->user_plan_id = $model->id;
        $invoice_no = $this->generaterechargeInvoiceNo();
        $payment->invoice_no = $invoice_no;
        $payment->subtotal = 0.00;
        $payment->tax = 0.00;
        $payment->total = 0.00;
        $payment->payment_status = 'captured';
        $payment->payment_mode = 'Free';
        $payment->payment_flag = 'Free';
        $payment->save();
    }

    public function EroorLogCheck($e, $controllername, $userid, $action) {
        $newfile = 'error_log_' . date("Y-m-d") . '.txt';
        $vaUrl = 'errorlog/' . $newfile;
        $handle = fopen($vaUrl, "a");
        $date = date('Y/m/d H:i:s');
        if (!file_exists($vaUrl)) {
            $myfile = fopen('errorlog/' . $newfile, "w");
            fwrite($handle, "\nError : " . '  Error Date/Time ' . $date . ' User ID -' . $userid . ' Controller Name  - ' . $controllername . ' Line No - ' . $e->getLine() . '  Error Message - ' . $e->getMessage() . '   Error Code :' . $e);
        } else {
            fwrite($handle, "\nError : " . '  Error Date/Time ' . $date . ' User ID - ' . $userid . ' Controller Name  - ' . $controllername . ' Line No - ' . $e->getLine() . '  Error Message - ' . $e->getMessage() . '    Error Code :' . $e);
        }
        return;
    }

    public function Erroremail($e) {
        $data = array();
        $cronEmail = new Email();
        $email = new UserEmail();
        $utility = new Utility();
        $user = new User();
        $data['user_name'] = Errorlogemailid;
        $email->primary_email = Errorlogemailid;
        if (filter_var($data['user_name'], FILTER_VALIDATE_EMAIL)) {
            $email->user_id = ErrorlogemailUserid;
            $email->version = 1;
            if ($email->validate()) {
                //$email->save();
                if (!empty(Errorlogemailid)) {
                    $emailTemplate = $utility->getsmsmsgTemplate('email', 'exception_email');
                    if (!empty($emailTemplate['body'])) {
                        $emailtemplatebody = $emailTemplate['body'];
                    }
                    $body = $utility->ExceptionTemplate($e);
                    $cronEmail->send_to = Errorlogemailid;
                    $cronEmail->send_from = email;
                    $cronEmail->body = $body;
                    $cronEmail->type = 'email';
                    if (!empty($emailTemplate['subject'])) {
                        $cronEmail->subject = $emailTemplate['subject'];
                    }
                    $cronEmail->created_at = new \yii\db\Expression('now()');
                    if ($cronEmail->validate()) {
                        $cronEmail->save();
                        $utility->sendsmsemail($cronEmail->id);
                        $user_status = 'enabled';
                        $logout_time = date("Y-m-d H:i:s");
                        $user->loginStatus(ErrorlogemailUserid, $user_status, $logout_time);
                    } else {
                        print_r($cronEmail->getErrors());
                        die;
                    }
                }
            }
        }
    }

    public function ExceptionTemplate($e) {
        $body = str_replace('${details}', !empty($e) ? $e : "", $e);
        return $body;
    }

    public function exceptionErrorDisplay($e) {
        $utility = new Utility();
        $controllername = Yii::$app->controller->id;
        $getuserid = !empty($_COOKIE["uid"]) ? $_COOKIE["uid"] : 0;
        if (!empty($getuserid)) {
            $userID = $utility->descriptionFormatforcookie($getuserid);
            $userid = $userID;
            $action = Yii::$app->controller->action->id;
            $utility->EroorLogCheck($e, $controllername, $userid, $action);
            $Errorlogemailid = Errorlogemailid;
            if (!empty($Errorlogemailid)) {
                $utility->Erroremail($e);
            }
        }
    }

    public function exceptionErrorCookiesBeforeAction($e) {
        $utility = new Utility();
        $controllername = Yii::$app->controller->id;
        $getuserid = !empty($_COOKIE["uid"]) ? $_COOKIE["uid"] : 0;
        if (!empty($getuserid)) {
            $userID = $utility->descriptionFormatforcookie($getuserid);
            $userid = $userID;
            $action = Yii::$app->controller->action->id;
            $utility->EroorLogCheck($e, $controllername, $userid, $action);
            $Errorlogemailid = Errorlogemailid;
            if (!empty($Errorlogemailid)) {
                $utility->Erroremail($e);
            }
        }
    }

    public function decryptUserID() {
        $utility = new Utility();
        $getuserid = !empty($_COOKIE["uid"]) ? $_COOKIE["uid"] : 0;
        if (!empty($getuserid)) {
            $userID = $utility->descriptionFormatforcookie($getuserid);
        } else {
            $userID = '';
        }
        return $userID;
    }

    public function Kycsavepandetails($pan, $uid, $username) {
        $userkyc = new UserKyc();
        $utility = new Utility();
        $userkyc->user_id = $uid;
        $userkyc->version = 1;
        $userkyc->pan_number = empty($pan) ? '' : $utility->encryptionFormat($pan);
        $userkyc->pan_number_hash = md5(strtoupper($pan));
        $userkyc->nationality = 'indian';
        $userkyc->created_at = new \yii\db\Expression('now()');
        $userkyc->created_by = $username;
        $userkyc->save();
    }

    /* FREE PORTFOLIO CHECK Email */

    public function freeportemail($dataarray) {
        $data = array();
        $cronEmail = new Email();
        $email = new UserEmail();
        $utility = new Utility();
        $user = new User();
        $emailTemplate = $utility->getsmsmsgTemplate('email', 'portfolio_check');
        if (!empty($emailTemplate['body'])) {
            $emailtemplatebody = $emailTemplate['body'];
        }
        if (!empty($emailTemplate['subject'])) {
            $emailtemplatesubject = $emailTemplate['subject'];
        }

        $time_now = mktime(date('h') + 5, date('i') + 30);
        $date = date('d-m-Y H:i', $time_now);
        $date = date("d-m-Y H:i:s");
        $body = $utility->PortfolioTemplate($dataarray['username'], $dataarray['email'], $dataarray['mobile'], $dataarray['pan'], $dataarray['userDateOfBirth'], $emailtemplatebody, $date);
        $cronEmail->send_to = 'members@pmsaifclub.com';
        $cronEmail->send_from = 'no-reply@pmsaifclub.com';
        $cronEmail->body = $body;
        $cronEmail->type = 'email';
        if (!empty($emailTemplate['subject'])) {
            $subject = $utility->PortfolioTemplatesubject($dataarray['pan'], $emailtemplatesubject);
            $cronEmail->subject = $subject;    //$emailTemplate['subject'];
        }
        $cronEmail->created_at = new \yii\db\Expression('now()');
        if ($cronEmail->validate()) {
            $cronEmail->save();
            $utility->sendsmsemail($cronEmail->id);
            $user_status = 'enabled';
            $logout_time = date("Y-m-d H:i:s");
            //$user->loginStatus(ErrorlogemailUserid, $user_status, $logout_time);
        } else {
            print_r($cronEmail->getErrors());
            die;
        }
    }

    public function PortfolioTemplate($name, $email, $mobile_no, $pan, $dob, $oldTemplate, $date) {
        $body = str_replace('${mobileNumber}', !empty($mobile_no) ? $mobile_no : "", $oldTemplate);
        $body = str_replace('${created_at}', !empty($date) ? $date : "", $body);
        $body = str_replace('${name}', !empty($name) ? $name : "", $body);
        $body = str_replace('${email}', !empty($email) ? $email : "", $body);
        $body = str_replace('${dob}', !empty($dob) ? $dob : "", $body);
        $body = str_replace('${pan}', !empty($pan) ? strtoupper($pan) : "", $body);
        return $body;
    }

    public function PortfolioTemplatesubject($pan, $oldTemplate) {
        $body = str_replace('${pan}', !empty($pan) ? strtoupper($pan) : "", $oldTemplate);
        return $body;
    }

    public function UploadDat($pdffile, $bucket) {
        ini_set('upload_max_filesize', '64M');
        set_time_limit(0);
        $bucketUrl = STATIC_S3_URL . '/' . $bucket . '/';
        $s3 = new S3(AWS_ACCESS_KEY, AWS_SECRET_KEY);
        if (!empty($pdffile)) {
            $sourcePath = CSV_URL . $pdffile;
            $s3->putObjectFile($sourcePath, $bucketUrl, $bucket . '/' . $pdffile, S3::ACL_PUBLIC_READ_WRITE);
        }
    }

    public function UploadKarvyExcel($pdffile, $bucket) {
        ini_set('upload_max_filesize', '64M');
        set_time_limit(0);
        $bucketUrl = STATIC_S3_URL . '/' . $bucket . '/';
        $s3 = new S3(AWS_ACCESS_KEY, AWS_SECRET_KEY);
        if (!empty($pdffile)) {
            $sourcePath = CSV_URL . $pdffile;
            $s3->putObjectFile($sourcePath, $bucketUrl, $bucket . '/' . $pdffile, S3::ACL_PUBLIC_READ_WRITE);
        }
    }

    public function UploadCamsExcel($pdffile, $bucket) {
        ini_set('upload_max_filesize', '64M');
        set_time_limit(0);
        $bucketUrl = STATIC_S3_URL . '/' . $bucket . '/';
        $s3 = new S3(AWS_ACCESS_KEY, AWS_SECRET_KEY);
        if (!empty($pdffile)) {
            $sourcePath = CSV_URL . $pdffile;
            $s3->putObjectFile($sourcePath, $bucketUrl, $bucket . '/' . $pdffile, S3::ACL_PUBLIC_READ_WRITE);
        }
    }

    public function userInviteSendSmsEmail($dataarray, $getInviteRefferalCode, $created_by) {
        // echo "<pre>"; print_r($dataarray); exit;

        $data = array();
        $cronEmail = new Email();
        $email = new UserEmail();
        $utility = new Utility();
        $user = new User();
        /* Send parameter */
        //$refferalCode = $utility->encryptionFormat($getInviteRefferalCode);
        $refferalCode = $getInviteRefferalCode;
        $username = $created_by;
        $member_name = $dataarray["name"];
        $registerURL = BASE_URL . "signin/register?referrercode=$refferalCode";
        $freePortfolioURL = BASE_URL . "free-mutual-fund-portfolio-check?referrercode=$refferalCode";
        /* End parameter */
        if (!empty($dataarray['email_id']) && !empty($dataarray['email'])) {
            $emailTemplate = $utility->getsmsmsgTemplate('email', 'invite_email');
            if (!empty($emailTemplate['body'])) {
                $emailtemplatebody = $emailTemplate['body'];
            }
            $body = $utility->InviteUserTemplate($username, $member_name, $registerURL, $freePortfolioURL, $emailtemplatebody);
            $cronEmail->send_to = $dataarray['email_id'];
            $cronEmail->send_from = email;
            $cronEmail->body = $body;
            $cronEmail->type = 'email';
            if (!empty($emailTemplate['subject'])) {
                $cronEmail->subject = $emailTemplate['subject'];
            }
            $cronEmail->created_at = new \yii\db\Expression('now()');
            if ($cronEmail->validate()) {
                $cronEmail->save();
                $utility->sendsmsemail($cronEmail->id);
            }
        }
        if (!empty($dataarray['mobile_number']) && !empty($dataarray['sms'])) {
            $cronEmail = new Email();
            $email = new UserEmail();
            $utility = new Utility();
            $user = new User();
            $smsTemplate = $utility->getsmsmsgTemplate('sms', 'invite_sms');
            if (!empty($smsTemplate['body'])) {
                $smstemplatebody = $smsTemplate['body'];
            }
            $body = $utility->InviteUserSmsTemplate($username, $member_name, $registerURL, $smstemplatebody);
            $cronEmail->send_to = $dataarray['mobile_number'];
            $cronEmail->send_from = sms_number;
            $cronEmail->body = $body;
            $cronEmail->type = 'sms';
            if (!empty($smsTemplate['subject'])) {
                $cronEmail->subject = $smsTemplate['subject'];
            }
            $cronEmail->created_at = new \yii\db\Expression('now()');
            if ($cronEmail->validate()) {
                $cronEmail->save();
                $utility->sendsmsemail($cronEmail->id);
            }
        }
    }

    public function InviteUserTemplate($username, $member_name, $registerURL, $freePortfolioURL, $oldTemplate) {
        //$body = str_replace('${mobileNumber}', !empty($mobile_no) ? $mobile_no : "", $oldTemplate);
        $body = str_replace('${name}', !empty($member_name) ? $member_name : "", $oldTemplate);
        $body = str_replace('${member_name}', !empty($username) ? $username : "", $body);
        $body = str_replace('${registerURL}', !empty($registerURL) ? $registerURL : "", $body);
        $body = str_replace('${freePortfolioURL}', !empty($freePortfolioURL) ? $freePortfolioURL : "", $body);
        $body = str_replace('${TnC}', BASE_URL . 'openterm/showtermsonmail?category=pmsaif', $body);
        return $body;
    }

    public function InviteUserSmsTemplate($username, $member_name, $registerURL, $oldTemplate) {
        $body = str_replace('${name}', !empty($member_name) ? $member_name : "", $oldTemplate);
        $body = str_replace('${member_name}', !empty($username) ? $username : "", $body);
        $body = str_replace('${registerURL}', !empty($registerURL) ? $registerURL : "", $body);
        return $body;
    }

    public function InviteUserTemplatesubject($pan, $oldTemplate) {
        $body = str_replace('${pan}', !empty($pan) ? strtoupper($pan) : "", $oldTemplate);
        return $body;
    }

    public function saveInEmail($smsOrEmail, $smsOrEmailTemplateName, $emailOrSmsContentTobeSendToUser, $sendToEmailOrMobile, $sendFromMobileOrEmail) {
        $cronEmail = new Email();
        $utility = new Utility();
        $smsTemplate = $utility->getsmsmsgTemplate($smsOrEmail, $smsOrEmailTemplateName);
        if (!empty($smsTemplate['body'])) {
            $smstemplatebody = $smsTemplate['body'];
        }
        $body = $emailOrSmsContentTobeSendToUser;
        $cronEmail->send_to = $sendToEmailOrMobile;
        $cronEmail->send_from = $sendFromMobileOrEmail;
        $cronEmail->body = $body;
        $cronEmail->type = $smsOrEmail;
        if (!empty($smsTemplate['subject'])) {
            $cronEmail->subject = $smsTemplate['subject'];
        }
        $cronEmail->created_at = new \yii\db\Expression('now()');
        if ($cronEmail->validate()) {
            $cronEmail->save();
            $utility->sendsmsemail($cronEmail->id);
        }
    }

    public function transReferencerelaine($sid, $folioid) {
        $connection = \Yii::$app->db;
        $sql = "select * from user_transaction where session_txn_id= '$sid' order by id desc";
        $command = $connection->createCommand($sql);
        $data = $command->queryOne();
        $id = $data['id'];
        date_default_timezone_set('Asia/Calcutta');
        $current_day_year = "";
        $current_year = "";
        $trans_id = "";
        $ref_number = "";
        if (!empty($id)) {
            $current_day_year = date('z') + 1;
            $current_year = date("y");
            $trans_id = $id;
            $ref_number = $this->transReferencereliance();
            $connection = \Yii::$app->db;
            $sql = "UPDATE user_transaction SET refrence_id= :rnum, transaction_status='requested',folio_id=$folioid WHERE id = :tid";
            $data = $connection->createCommand($sql)
                    ->bindValue(":tid", $trans_id)
                    ->bindValue(":rnum", $ref_number)
                    ->execute();
            return $data;
        }
    }

    public function folioNumberdata($fid, $sid, $uid) {
        $connection = \Yii::$app->db;
        $sql = "SELECT folio_number FROM user_folio WHERE user_id=$uid AND id=$fid AND scheme_id=$sid";
        $command = $connection->createCommand($sql);
        $data = $command->queryOne();
        return $data;
    }

    public function CkyLogCheck($e, $controllername, $userid, $action) {

        $newfile = 'CKYC_log_' . date("Y-m-d") . '.txt';
        $vaUrl = 'errorlog/' . $newfile;
        $handle = fopen($vaUrl, "a");
        $date = date('Y/m/d H:i:s');
        if (!file_exists($vaUrl)) {
            $myfile = fopen('errorlog/' . $newfile, "w");
            fwrite($handle, "\nLog : " . '  Log Date/Time ' . $date . ' Function Name  - ' . $controllername . '  occupation name :' . $e);
        } else {
            fwrite($handle, "\nLog : " . '  Log Date/Time ' . $date . ' Function Name - ' . $controllername . '  occupation name :' . $e);
        }
        return;
    }

    public function transReferencePEBand() {
        date_default_timezone_set('Asia/Calcutta');
        $current_day_year = date('z') + 1;
        $time = date("his");
        $current_year = date("y");
        //$randDome2Digits = $this->PeBandRef();
        $randDome2Digits = "";
        for ($i = 0; $i < 4; $i++) {
            $randDome2Digits .= mt_rand(1, 9);
        }
        $ref_number = "PR" . $current_day_year . $time . $randDome2Digits;
        return $ref_number;
    }

    public function UserNamedata($id) {
        $connection = Yii::$app->getDb();
        $sql = "SELECT username FROM user WHERE id =$id order by id desc";
        $command = $connection->createCommand($sql);
        $data = $command->queryOne();
        return $data;
    }

    public function Sessionexipary() {
        $url = BASE_URL . 'signin/loging';
        echo "<script> window.location = '" . $url . "'; </script>";
    }

    public function Flagupdatecheckcall($user_id) {
        $url = BASE_URL . "apibeforeaction/flagupdatecheck";
        $ch = curl_init($url);
        # Setup request to send json via POST.
        $payload = json_encode(array("userId" => $user_id));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        # Return response instead of printing.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        # Send request.
        $responseresult = curl_exec($ch);
        curl_close($ch);
    }

    public function EroorLogGenerator($e) {
        $newfile = 'error_log_kyc' . date("Y-m-d") . '.txt';
        $vaUrl = 'errorlog/' . $newfile;
        $handle = fopen($vaUrl, "a");
        $date = date('Y/m/d H:i:s');
        if (!file_exists($vaUrl)) {
            $myfile = fopen('errorlog/' . $newfile, "w");
            fwrite($handle, "\nError : " . '  Error Date/Time ' . $date . ' Error Code :' . $e);
        } else {
            fwrite($handle, "\nError : " . '  Error Date/Time ' . $date . '    Error Code :' . $e);
        }
        return;
    }

    public function getusertokenidMaster($userId) {
        $utility = new Utility();
        $tokenGenYesNo = '';
        if (empty($_SESSION)) {
            $this->Sessionexipary();
        } else {
            if (isset($_SESSION['tokenId']) && (!empty($_SESSION['tokenId']))) {
                $sessionTokenId = $_SESSION['tokenId'];
                $tokenId = $utility->descriptionFormat($sessionTokenId);
                $tokenGenYesNo['tokenId'] = $tokenId;
            }
        }

        return $tokenGenYesNo;
    }

    public function getTokenIdFromMaster($userId) {
        $tokenMaster = new TokenMaster();
        $tokenGenYesNo = $tokenMaster->getTokenVal($userId);
        return $tokenGenYesNo;
    }

    public function getSessionTokenIdMaster() {
        $utility = new Utility();
        $tokenGenYesNo = '';
        if (isset($_SESSION['tokenId']) && (!empty($_SESSION['tokenId']))) {
            $sessionTokenId = $_SESSION['tokenId'];
            $tokenGenYesNo = $utility->descriptionFormat($sessionTokenId);
        }
        return $tokenGenYesNo;
    }

    public function ChangeSignupTemplateadvisor($name, $oldTemplate) {
        $body = str_replace('${name}', !empty($name) ? $name : "", $oldTemplate);
        $body = str_replace('Name:', "", $body);
        return $body;
    }

    public function saveInEmailInvoidPDF($htmlmail, $invoicemailsubject, $fromemail, $emailType, $primaryEmail) {

        $cronEmail = new Email();
        $utility = new Utility();
        $cronEmail->send_to = $primaryEmail;
        $cronEmail->send_from = $fromemail;
        $cronEmail->body = $htmlmail;
        $cronEmail->type = $emailType;
        $cronEmail->subject = $invoicemailsubject;
        $cronEmail->created_at = new \yii\db\Expression('now()');
        if ($cronEmail->validate()) {
            $cronEmail->save();
            $utility->sendsmsemail($cronEmail->id);
        }
    }

    public function Moneyformatvalue($value, $digit) {
        $valuemoneyformate = 0;
        if (!empty($value)) {
            $user = new User();
            $valuemoneyformate = $user->moneyFormatIndia($value, $digit); // current market Value Money Formate For View Screen
            if ($value > 0) {
                $valuemoneyformate = $valuemoneyformate;
            } else {
                if ($value < 0 && $value < -99) {
                    $valuemoneyformate = '-' . $valuemoneyformate;
                } else {
                    $valuemoneyformate = $valuemoneyformate;
                }
            }
        }
        return $valuemoneyformate;
    }

    public function Removesubless($val) {
        if ($val < 99) {
            $value = $val;
        } else {
            $value = '-' . $val;
        }
        return $value;
    }

    public function sendsmsemail($emailid) {
        $messagedis = [];
        if (!empty($emailid)) {
            $utility = new Utility();
            $connection = \Yii::$app->db;
            $sql = "select id,send_from,cc,bcc,send_to,subject,body,type from email where status=0 and id=:id";
            $catData = $connection->createCommand($sql)->bindValue(":id", $emailid)->queryAll();
            if (!empty($catData)) {
                foreach ($catData as $data) {
                    if ($data['type'] == 'email') {
                        Yii::$app->mailer->compose()
                                ->setTo($data['send_to'])
                                ->setFrom($data['send_from'])
                                ->setSubject($data['subject'])
                                ->setCc($data['cc'])
                                ->setHtmlBody($data['body'])
                                ->send();
                    }
                    $sql_update = "update email set status=1 where id=" . $data['id'];
                    $upadte = $connection->createCommand($sql_update)->execute();
                    $messagedis["success"] = "success";
                }
            } else {
                $messagedis["success"] = "No records found";
            }
        } else {
            $messagedis["success"] = "emailid should not be empty";
        }
        return $messagedis;
    }

    public function username($user_id) {
        $connection = \Yii::$app->db;
        $sql = "SELECT * FROM user WHERE id = $user_id";
        $command = $connection->createCommand($sql);
        $data = $command->queryOne();
        $username = '';
        if (!empty($data)) {
            $username = $data['username'];
        }
        return $username;
    }


}
