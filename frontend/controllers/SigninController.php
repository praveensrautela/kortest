<?php

namespace frontend\controllers;

use Yii;
use yii\web\S3;
use yii\base\Exception;
use yii\base\ErrorException;
use yii\helpers\Security;
use common\models\User;
use common\models\Utility;
use common\models\Otp;
use common\models\APIotpUtility;
use common\models\Email;
use common\models\LoginStatus;

class SigninController extends \yii\web\Controller
{

    public $enableCsrfValidation = false;
    public $_userid = NULL;

    public function actions()
    {
        return [
            'oauth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successOAuthCallback'],
            ]
        ];
    }

    public function beforeAction($action)
    {
        if (isset($_COOKIE['user-name'])) {
            Yii::$app->view->params['user-remember'] = $_COOKIE['user-name'];
        } else {
            Yii::$app->view->params['user-remember'] = '';
        }
        return TRUE;
    }

    public function actionIndex()
    {
        try {
            $user = new User();
            return $this->render('index', [
                'model' => $user,
            ]);
        } catch (ErrorException $e) {
            $utility = new Utility();
            $this->redirect(BASE_URL . '');
        }
    }

    public function actionError()
    {
        try {
            $user = new User();

            return $this->render('error', [
                'model' => $user,
            ]);
        } catch (ErrorException $e) {
            $utility = new Utility();
            $utility->exceptionErrorDisplay($e);
            return $this->render('errorlog', [
                'e' => $e
            ]);
        }
    }

    public function actionRegister()
    {
        try {
            $user = new User();
            $usertype = $user->Useraccess();
            $utility = new Utility();
            if (isset($_COOKIE['uid'])) {
                unset($_COOKIE['uid']);
                setcookie('uid', null, -1, '/');
            }
            if (isset($_COOKIE['user_access'])) {
                unset($_COOKIE['user_access']);
                setcookie('user_access', null, -1, '/');
            }
            if (isset($_COOKIE['user_invester_access'])) {
                unset($_COOKIE['user_invester_access']);
                setcookie('user_invester_access', null, -1, '/');
            }
            return $this->render('register', [
                'model' => $user,
                'usertype' => $usertype
            ]);
        } catch (ErrorException $e) {
            $utility = new Utility();
            $utility->exceptionErrorDisplay($e);
            return $this->render('errorlog', [
                'e' => $e
            ]);
        }
    }

    public function actionLoging($token = '')
    {
        session_start();
        $utility = new Utility();
        $user = new User();
        $logSessionId = $utility->getSessionTokenIdMaster();
        if (!empty($logSessionId)) {
            date_default_timezone_set('Asia/Calcutta');
            $expiryDate = date("Y-m-d H:i:s");
            $usergetTokenId = $user->tokenMasterExpirStatus($logSessionId, $expiryDate);
        }
        //Added code for deactivate status
        if (isset($_COOKIE['uid'])) {
            unset($_COOKIE['uid']);
            setcookie('uid', null, -1, '/');
        }
        if (isset($_COOKIE['user_access'])) {
            unset($_COOKIE['user_access']);
            setcookie('user_access', null, -1, '/');
        }
        if (isset($_COOKIE['user_invester_access'])) {
            unset($_COOKIE['user_invester_access']);
            setcookie('user_invester_access', null, -1, '/');
        }

        //session destroy
        if (isset($_SESSION['getCurrentMVProce']) && !empty($_SESSION['getCurrentMVProce'])) {
            $session = Yii::$app->session;
            $session->remove('getCurrentMVProce');
        }
        //session destroy

        /*         * * End code for Destroy cookies** */
        if (!empty($_REQUEST['log_id'])) {
            $model = new \common\models\User();
            $rows = $model->Logingpage($_REQUEST['log_id']);
            $url1 = base64_encode("singleuser&user_id=" . $_REQUEST['log_id']);
            $url2 = base64_encode("multiuser&user_id=" . $_REQUEST['log_id']);
            if (count($rows) == 1) {
                return Yii::$app->getResponse()->redirect('index?logid=' . $url1);
            } else if (count($rows) > 1) {
                return Yii::$app->getResponse()->redirect('index?logid=' . $url2);
                //return Yii::$app->getResponse()->redirect('index?logid=multiuser&user_id='.$_REQUEST['log_id']); 
            } else if (count($rows == 0)) {
                Yii::$app->getSession()->setFlash('error', 'invalid user id');
                return Yii::$app->getResponse()->redirect('loging');
            }
        } else {

            $message = '';
            if (!empty($token)) {
                $user = new User();
                $userEmail = new UserEmail();
                $utility = new Utility();
                $data = explode('-$', $token);
                $ndata = isset($data[0]) ? $data[0] : 0;
                $verifyToken = $utility->decrypt($ndata);
                $verifydata = explode('|', $verifyToken);
                if (count($data) > 1 && count($verifydata) > 1) {
                    $authkey = $data[1];
                    $userid = $verifydata[0];
                    $emailtype = $verifydata[1];
                    $user = User::find()->where(['id' => $userid])->one();
                } else {
                    $message = 'Invalid Token';
                    Yii::$app->view->params['meta'] = '';
                    Yii::$app->view->params['page'] = '';
                    //return $this->render('index', ['message' => $message]);
                }
            }
        }
        try {
            $user = new User();
            return $this->render('loging', [
                'model' => $user,
                'message' => $message,
            ]);
        } catch (ErrorException $e) {
            $utility = new Utility();
            $utility->exceptionErrorDisplay($e);
            return $this->render('errorlog', [
                'e' => $e
            ]);
        }
    }

    public function actionSignupdobregischeck()
    {

        $user = new User();
        $session = Yii::$app->session;
        date_default_timezone_set('Asia/Calcutta');
        $last_activity_time = date("Y-m-d H:i:s");
        $mobNo = $_POST['value'];
        if (empty($mobNo)) {
            $mobNo = '';
        }
        $emailId = $_POST['useremail'];
        if (empty($emailId)) {
            $emailId = '';
        }
        $checkuser = $user->RegisterSignupCheck($mobNo, $emailId);
        if (!empty($checkuser)) {
            return true;
        } else {
            return false;
        }
    }

    public function actionVerifymemberid()
    {
        try {
            $data = Yii::$app->request->post();
            $usercode = new User();
            $msg = [];
            $countTotalUser = 0;
            if (!empty($data['user_name']) && ($countTotalUser == 0)) {
                $countTotalUser = $usercode->getTotalUser(base64_decode($data['user_name']));
            }
            if (!empty($data['mobileNo']) && ($countTotalUser == 0)) {
                $countTotalUser = $usercode->getTotalUser(base64_decode($data['mobileNo']));
            }
            if ($countTotalUser >= 10) {
                $msg['message'] = "error";
                $msg['userOrgCode'] = "10"; // user cross the limit same mobile and email
            }
            //End code 
            else {
                if (!empty($data) && empty($message)) {
                    if (empty($message)) {
                        // $memberType = $usercodeMemberTypeId["user_org_code"];
                        $msg['message'] = "success";
                        $msg['userOrgCode'] = '50';
                    } else {
                        $msg['message'] = "error";
                        $msg['userOrgCode'] = '';
                    }
                } else {
                    $msg['message'] = "error";
                    $msg['userOrgCode'] = '';
                }
            }
            return json_encode($msg);
        } catch (ErrorException $e) {
            $utility = new Utility();
            $utility->exceptionErrorDisplay($e);
            return $this->render('errorlog', [
                'e' => $e
            ]);
        }
    }

    public function actionSignupotpsend()
    {
        try {
            $utility = new Utility();
            $user = new User();
            $session = Yii::$app->session;
            date_default_timezone_set('Asia/Calcutta');
            $last_activity_time = date("Y-m-d H:i:s");
            $session->set('last_activity', $last_activity_time);
            $data = Yii::$app->request->post();

            if (!empty($data['password'])) {
                $count = $user->getUserVerified(base64_decode($data['user_name']), md5(base64_decode($data['user_date_of_birth'])), base64_decode($data['password']));
            } else {
                $count = 0;
            }
            $message = '';
            if ($count == 0) {

                $userdata = 0;
                $password = '';
                $mobileNumber = base64_decode($data['mobileNo']);
                $emailId = base64_decode($data['user_name']);
                if (!empty($data['password'])) {
                    if (!empty($mobileNumber) && ($userdata == 0) && empty($message)) {
                        $userdata = $user->getUserVerified(base64_decode($data['mobileNo']), md5(base64_decode($data['user_date_of_birth'])), base64_decode($data['password']));
                    }
                    $password = base64_decode($data['password']);
                }
                if (($count == 0) && ($userdata == 0) && empty($message)) {
                    $mobileNumber = base64_decode($data['mobileNo']);
                    $userSignupEmails = base64_decode($data['user_name']);
                    $userDateOfBirth = base64_decode($data['user_date_of_birth']);
                    if (!empty($data) && !empty($mobileNumber) && empty($message)) {
                        $userdata = 0;
                        if (!empty($password)) {
                            if (!empty($mobileNumber) && ($userdata == 0) && empty($message)) {
                                $userdata = $user->getUserVerified($userSignupEmails, md5($userDateOfBirth), $password);
                            } else if (!empty($mobileNumber) && ($userdata == 0) && empty($message)) {
                                $userdata = $user->getUserVerified($mobileNumber, md5($userDateOfBirth), $password);
                            }
                        }
                        if (($userdata == 0) && empty($message)) {
                            $utility = new Utility();
                            $user = new User();
                            $otpUtility = new APIotpUtility();
                            date_default_timezone_set('Asia/Calcutta');
                            $createdUpdatedat = date("Y-m-d H:i:s");
                            $otp = $utility->OTP();
                            $expiretime = $utility->ExpireMinutesTime();
                            $deactivateId = $otpUtility->seachMobileNoDeactivate($mobileNumber);
                            $getResponseVal = $otpUtility->userSendOtpVer($data['user_primary_name'], $userSignupEmails, $mobileNumber, $userDateOfBirth, $otp, 1, $expiretime, $createdUpdatedat, $data['user_primary_name'], $data['user_primary_name']);
                            $message = $getResponseVal;
                        } else {
                            $message['message'] = "error";
                            $message["error"] = $GLOBALS['messages']['userRegistration']['userExist'];
                        }
                    } else {
                        $message['message'] = "error";
                        $message["error"] = $GLOBALS['messages']['userRegistration']['InvalidParameter'];
                    }
                } else {
                    $message['message'] = "error";
                    $message['userexist'] = "exist";
                    $message["error"] = $GLOBALS['messages']['userRegistration']['userExist'];
                }
            } else {
                $message['message'] = "error";
                $message['userexist'] = "exist";
                $message["error"] = $GLOBALS['messages']['userRegistration']['userExist'];
            }
            return json_encode($message);
            ;
        } catch (ErrorException $e) {
            $utility = new Utility();
            $utility->exceptionErrorDisplay($e);
            return $this->render('errorlog', [
                'e' => $e
            ]);
        }
    }

    public function actionSignupotpverify()
    {
        try {
            $utility = new Utility();
            $user = new User();
            $session = Yii::$app->session;
            date_default_timezone_set('Asia/Calcutta');
            $last_activity_time = date("Y-m-d H:i:s");
            $session->set('last_activity', $last_activity_time);
            $data = Yii::$app->request->post();
            $message = '';
            if (!empty($data) && empty($message)) {
                $mobileNumber = base64_decode($data['mobileNo']);
                $userEnterOtp = $data['otp'];
                if (empty($message)) {
                    $mobileNumber = base64_decode($data['mobileNo']);
                    $verifyOtp = $userEnterOtp;
                    $updated_by = $data['user_primary_name'];
                    if (!empty($data) && !empty($mobileNumber) && !empty($verifyOtp)) {
                        $otp = Otp::find()->where(['mobile_number' => $mobileNumber])->andWhere(['otp' => $verifyOtp])->andWhere(['is_active' => 1])->one();
                        if (!empty($otp)) {
                            if (strtotime(date('Y-m-d H:i:s')) < strtotime($otp->otp_expire)) {
                                $otp->is_active = '0';
                                if ($otp->validate()) {
                                    if ($otp->save()) {
                                        $message['message'] = "success";
                                        $message["success"] = $GLOBALS['messages']['userRegistration']['OtpVerify'];
                                    } else {
                                        $message['message'] = "error";
                                        $message["error"] = $GLOBALS['messages']['userRegistration']['oops'];
                                    }
                                }
                            } else {
                                $message['message'] = "error";
                                $message["error"] = $GLOBALS['messages']['userRegistration']['OtpExpire'];
                            }
                        } else {
                            $message['message'] = "error";
                            $message["error"] = $GLOBALS['messages']['userRegistration']['OtpMisMatch'];
                        }
                    } else {
                        $message['message'] = "error";
                        $message["error"] = $GLOBALS['messages']['userRegistration']['InvalidParameter'];
                    }
                    return json_encode($message);


                    $message = $verifyOtp;
                } else {
                    $message['message'] = "error";
                    $message["error"] = $GLOBALS['messages']['userRegistration']['InvalidParameter'];
                    $message = json_encode($message);
                }
            } else {
                $message['message'] = "error";
                $message["error"] = $GLOBALS['messages']['userRegistration']['InvalidParameter'];
                $message = json_encode($message);
            }
            return $message;
        } catch (ErrorException $e) {
            $utility = new Utility();
            $utility->exceptionErrorDisplay($e);
            return $this->render('errorlog', [
                'e' => $e
            ]);
        }
    }

    public function actionSignup()
    {
        ini_set('max_execution_time', 0);
        $session = Yii::$app->session;
        try {
            $user = new User();
            $utility = new Utility();
            $data = Yii::$app->request->post();
            $message = [];
            if (!empty($data)) {
                $count = 0;
                if (!empty($data['user_name']) && ($count == 0)) {
                    $count = $user->getUser(base64_decode($data['user_name']), md5(base64_decode($data['user_date_of_birth'])), base64_decode($data['password']));
                }
                if (!empty($data['mobileNo']) && ($count == 0)) {
                    $count = $user->getUser(base64_decode($data['mobileNo']), md5(base64_decode($data['user_date_of_birth'])), base64_decode($data['password']));
                }
                if ($count == 0) {
                    if (!empty($data['mobileNo'])) {
                        $mobileNumber = base64_decode($data['mobileNo']);
                    }
                    $dobdate = base64_decode($data['user_date_of_birth']);
                    if (!empty($dobdate)) {
                        $user->date_of_birth = md5($dobdate);
                    }
                    if (!empty($data['password'])) {
                        $user->password_hash = base64_decode($data['password']);
                        $user->setPassword($user->password_hash);
                        $user->password_reset_token = $user->password_hash;
                    }
                    $user->username = $data['user_primary_name'];
                    $account_type = $data['account_type'];
                    $user->user_access_id = "$account_type";
                    if (!empty($data['user_name'])) {
                        $userName = base64_decode($data['user_name']);
                    } else {
                        $userName = '';
                    }
                    $user->email = $userName;
                    $user->mobile = base64_decode($data['mobileNo']);
                    if ($user->validate()) {
                        $user->save();
                        $cronEmail = new Email();
                        $user_id = $user->id;
                        setcookie('uid', $user_id, time() + 63072000, '/');
                        $session = Yii::$app->session;
                        $last_activity_time = date("Y-m-d H:i:s");
                        $session->set('last_activity', $last_activity_time);
                        if (!empty(base64_decode($data['user_name']))) {
                            $emailTemplate = $utility->getsmsmsgTemplate('email', 'register');
                            if (!empty($emailTemplate['body'])) {
                                $emailtemplatebody = $emailTemplate['body'];
                            }
                            $body = $utility->ChangeSignupTemplate($user->username, $user->mobile, $userName, base64_decode($data['user_date_of_birth']), $emailtemplatebody, '');
                            $cronEmail->send_to = $user->email;
                            $cronEmail->send_from = email;
                            $cronEmail->body = $body;
                            $cronEmail->type = 'email';
                            if (!empty($emailTemplate['subject'])) {
                                $cronEmail->subject = $emailTemplate['subject'];
                            }
                            // $cronEmail->created_at = new \yii\db\Expression('now()');

                            if ($cronEmail->validate()) {
                                $cronEmail->save();
                                if (emailsendflag != 'off') {
                                    $utility->sendsmsemail($cronEmail->id);
                                }
                            } else {
                                print_r($cronEmail->getErrors());
                                die;
                            }
                        }

                        $message['message'] = "success";
                        $message['userexist'] = 1;
                        $message = json_encode($message);
                    }
                } else {
                    $message['message'] = "error";
                    $message['userexist'] = "exist";
                    $message["error"] = 'User Already Exist';
                    $message = json_encode($message);
                }
                return $message;
            }
        } catch (ErrorException $e) {
            $utility = new Utility();
            $utility->exceptionErrorDisplay($e);
            return $this->render('errorlog', [
                'e' => $e
            ]);
        }
    }

    public function actionLogin()
    {
        try {
            $user_name = $password = $browserdeatil = "";
            $add_flag = 0;
            $data = Yii::$app->request->post();
            date_default_timezone_set('Asia/Calcutta');
            $user = new User();
            $loginStatus = new LoginStatus();
            if (isset($_COOKIE['user-name']) && ($data['user_name'] == $_COOKIE['user-name'])) {
                setcookie('user-name', '', -3600, '/');
            }
            if (!empty($data['user_name'])) {
                $user_name = base64_decode($data['user_name']);
            }
            if (!empty($data['password'])) {
                $password = base64_decode($data['password']);
            }
            $userid = $user->getUserForlogin1($user_name, $password);
            $user = new User();
            if (!empty($userid)) {
                $user_status = 'enabled';
                $browserDetail = "";
                $logout_time = date("Y-m-d H:i:s");
                $logins = User::findIdentity($userid);
                $usertypedata = $user->usertypedata($userid);
                $usertype = '';
                if (!empty($usertypedata)) {
                    $usertype = $usertypedata['user_type'];

                }
                if (Yii::$app->user->login($logins)) {
                    $loginStatus->user_id = $userid;
                    $loginStatus->login_id = $user_name;
                    $loginStatus->login_time = date("Y-m-d H:i:s");
                    $loginStatus->os_details = '';
                    $loginStatus->browserdetails = '';
                    // $loginStatus->dob = $user_date_of_birth;
                    $loginStatus->session_id = Yii::$app->session->id;

                    if (!empty($_SERVER['REMOTE_ADDR'])) {
                        $loginStatus->origination_IP = $_SERVER['REMOTE_ADDR'];
                    }
                    if ($loginStatus->validate()) {
                        $loginStatus->save();
                    }

                    //setcookie('uid', Yii::$app->user->identity->id, time() + SESSION_TIME, '/');
                    /*                     * ****Cookie********* */
                    $uid = Yii::$app->user->identity->id;
                    //$uid = $utility->encryptionFormatforcookie($UserID);
                    // $investors = $utility->encryptionFormat("investors");
                    setcookie('uid', $uid, time() + 63072000, '/');
                    $session = Yii::$app->session;
                    date_default_timezone_set('Asia/Calcutta');
                    $last_activity_time = date("Y-m-d H:i:s");
                    $session->set('last_activity', $last_activity_time);
                    return $json_response = json_encode(['profile_completed' => '', 'result' => 1, 'user_type' => $usertype]);
                } else {
                    $loginStatus->login_id = $user_name;
                    $loginStatus->login_time = date("Y-m-d H:i:s");
                    $loginStatus->os_details = '';
                    $loginStatus->browserdetails = '';
                    // $loginStatus->dob = $user_date_of_birth;
                    $loginStatus->session_id = Yii::$app->session->id;
                    if (!empty($_SERVER['REMOTE_ADDR'])) {
                        $loginStatus->origination_IP = $_SERVER['REMOTE_ADDR'];
                    }
                    if ($loginStatus->validate()) {
                        $loginStatus->save();
                    }
                    return $json_response = json_encode(['profile_completed' => '', 'result' => 1, 'user_type' => $usertype]);
                }
            } else {
                return $json_response = json_encode(['profile_completed' => '', 'result' => 3]);
            }
        } catch (ErrorException $e) {
            $utility = new Utility();
            $utility->exceptionErrorDisplay($e);
            return $this->render('errorlog', [
                'e' => $e
            ]);
        }
    }

    public function actionLogout()
    {

        try {
            $user = new User();
            $utility = new Utility();

            return $this->redirect(HOME_URL, 302);
        } catch (ErrorException $e) {
            $utility = new Utility();
            $utility->exceptionErrorDisplay($e);
            //return $this->render(
            $this->redirect(HOME_URL);
        }
    }

    public function actionForgotpassword()
    {
        $data = Yii::$app->request->post();
        $user = new User();
        $message = [];
        if (!empty($data)) {
            $email = base64_decode($data['user_name']);
            $checkuser = $user->checkemail($email);
            if (!empty($checkuser)) {
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $randum = '';
                for ($i = 0; $i < 8; $i++) {
                    $randum .= $characters[mt_rand(0, 61)];
                }
                $enc_email = substr($checkuser['email'], 0, 2) . '************' . strstr($checkuser['email'], '@');
                if (!empty($checkuser['email'])) {
                    $cronEmail = new Email();
                    $utility = new Utility();
                    $emailTemplate = $utility->getsmsmsgTemplate('email', 'forgot_password');
                    if (!empty($emailTemplate['body'])) {
                        $body = str_replace('${password}', !empty($randum) ? $randum : "", $emailTemplate['body']);
                        $body = str_replace('${email}', !empty($checkuser['email']) ? $checkuser['email'] : "", $body);
                        $cronEmail->send_to = $checkuser['email'];
                        $cronEmail->send_from = email;
                        $cronEmail->body = $body;
                        $cronEmail->type = 'email';
                        if (!empty($emailTemplate['subject'])) {
                            $cronEmail->subject = $emailTemplate['subject'];
                        }
                        $cronEmail->created_at = new \yii\db\Expression('now()');
                        if ($cronEmail->validate()) {
                            $cronEmail->save();
                            if (emailsendflag != 'off') {
                                $utility->sendsmsemail($cronEmail->id);
                            }
                        } else {
                            print_r($cronEmail->getErrors());
                            die;
                        }
                        $message = 'Password has been sent to your registered email ' . $enc_email;
                    }
                    $connection = \Yii::$app->db;
                    $curdatetime = date("Y-m-d H:i:s");
                    $newPassword = Security::generatePasswordHash($randum);
                    $dateago = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($curdatetime)));
                    $sql = "update user set password_hash='" . $newPassword . "' where id =" . $checkuser['id'];
                    $command = $connection->createCommand($sql)->execute();
                    return $message;
                } else {
                    return 'Invalid Credentials';
                }
            } else {
                return 'Invalid Credentials';
            }
        }

        return $this->render('forgotpassword', [
        ]);
    }


}
