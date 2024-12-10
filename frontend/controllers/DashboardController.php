<?php
namespace frontend\controllers;

use common\models\User;
use common\models\Utility;
use ErrorException;
use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class DashboardController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $enableCsrfValidation = false;
    public $_userid = NULL;
    public $_username = null;

    public function beforeAction($action)
    {
        date_default_timezone_set('Asia/Calcutta');
        session_start();
        $utility = new Utility();
        try {
            $getuserid = !empty($_COOKIE["uid"]) ? $_COOKIE["uid"] : 0;
        } catch (ErrorException $e) {
            $utility = new Utility();
            $getuserid = !empty($_COOKIE["uid"]) ? $_COOKIE["uid"] : 0;
            $this->redirect(BASE_URL . 'loging');
        }

        if (!empty($getuserid)) {
            //  $this->_userid = $utility->descriptionFormatforcookie($getuserid);
            $this->_userid = $getuserid;
        }
        $curdatetime = date("Y-m-d H:i:s");
        if (empty($this->_userid) || empty($_SESSION) || (empty($_SESSION['last_activity']) && ((strtotime($curdatetime) - strtotime($_SESSION['last_activity'])) > \Yii::$app->getSession()->timeout))) {
            \Yii::$app->getSession()->setFlash('user_status', 'Session Timeout');
            $this->redirect(BASE_URL . 'loging');
        } else {
            $utility = new Utility();
            $user = new User();
            $user_id = $this->_userid;
            try {
                $this->_username = Yii::$app->user->identity->username;
            } catch (ErrorException $e) {
                $this->_username = '';
            }
            $user_info = $user->getUserInfo($this->_userid);
            // if ($user_info['id'] == 2) {
            //$plan = $utility->planUpdate($this->_userid, $this->_username);
            // }
            $this->view->params['user_info'] = $user_info;
            $this->layout = 'user';
            return $this->_userid;
        }
    }


    public function actionIndex()
    {

        // API URL
        $apiUrl = "https://kortests.com/api/cost/test/gke-cluster1";

        // Initialize cURL
        $curl = curl_init();

        // cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true, // Return response instead of outputting it
            CURLOPT_FOLLOWLOCATION => true, // Follow redirects
            CURLOPT_HTTPHEADER => [         // Optional headers
                'Content-Type: application/json',
            ],
            CURLOPT_TIMEOUT => 30,          // Set timeout (in seconds)
        ]);

        // Execute the request
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            $error = curl_error($curl);
            curl_close($curl);
            return "cURL Error: " . $error;
        }

        // Close cURL session
        curl_close($curl);

        // Decode JSON response if needed

        $data = json_decode($response, true);


        // Pass response to the view
        return $this->render('dashboard', [
            'apiResponse' => $data,
        ]);


    }

    public function actionCluster()
    {
        return $this->render('cluster');

    }

}
