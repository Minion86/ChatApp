<?php

if (!isset($_SESSION)) {
    session_start();
}

class AjaxuserController extends CController {

    public $code = 2;
    public $msg;
    public $details;
    public $data;
    public $db;

    public function __construct() {
        $this->data = $_POST;
        if (isset($_GET['sEcho'])) {
            $this->data = $_GET;
        }
        $this->db = new DbExt();
    }

    public function init() {
        
    }

    private function jsonResponse() {
        $resp = array('code' => $this->code, 'msg' => $this->msg, 'details' => $this->details);
        echo CJSON::encode($resp);
        Yii::app()->end();
    }

    public function actionLogin() {
        $req = array(
            'email' => Driver::t("Email es requerido"),
            'password' => Driver::t("password es requerido"),
        );
        $Validator = new Validator;
        $Validator->required($req, $this->data);
        if ($Validator->validate()) {

            if ($res = Driver::LoginUser(trim($this->data['email']), trim($this->data['password']))) {

                $_SESSION['chatapp'] = $res;
                $this->code = 1;
                $this->msg = Driver::t("Login Successful");
                $this->details = Yii::app()->createUrl('/user/chat');

                if (isset($this->data['remember'])) {
                    Yii::app()->request->cookies['kt_username'] = new CHttpCookie('kt_username', $this->data['email']);
                    $runtime_path = Yii::getPathOfAlias('webroot') . "/protected/runtime";
                    if (!file_exists($runtime_path)) {
                        mkdir($runtime_path, 0777);
                    }

                    $encryption_type = Yii::app()->params->encryption_type;
                    if (empty($encryption_type)) {
                        $encryption_type = 'yii';
                    }

                    if ($encryption_type == "yii") {
                        try {
                            $password = Yii::app()->securityManager->encrypt($this->data['password']);
                            Yii::app()->request->cookies['kt_password'] = new CHttpCookie('kt_password', $password);
                        } catch (Exception $e) {
                            $this->msg = Driver::t("Path is not writable by the server") . " $runtime_path";
                            $this->code = 2;
                        }
                    }
                } else {
                    unset(Yii::app()->request->cookies['kt_username']);
                    unset(Yii::app()->request->cookies['kt_password']);
                }
                //} else
                // $this->msg = t("Login failed. your account is") . " " . $res['status'];
            } else
                $this->msg = Driver::t("Login failed, email or password incorrect");
        } else
            $this->msg = $Validator->getErrorAsHTML();
        $this->jsonResponse();
    }

    public function actionaddUser() {

        $params = $this->data;

        if ($res = Driver::getUserByEmail($this->data['email'])) {
            $this->msg = Driver::t("Email already exists");
            $this->jsonResponse();
            Yii::app()->end();
        }


        unset($params['action']);

//        $params['email'] = $this->data['email'];
//        $params['name'] = $this->data['name'];
//        $params['password'] = $this->data['password'];
//        $params['currency'] = $this->data['currency'];
        $encryption_type = Yii::app()->params->encryption_type;
        if (empty($encryption_type)) {
            $encryption_type = 'yii';
        }

        if ($encryption_type == "yii") {
            $params['password'] = CPasswordHelper::hashPassword($params['password']);
        } else
            $params['password'] = md5($params['password']);

        if ($this->db->insertData("{{users}}", $params)) {
            $last_id = Yii::app()->db->getLastInsertID();
            $params2['id_user'] = $last_id;
            $params2['date_sent'] = date('Y-m-d G:i:s');
            $params2['sender'] = "chatbot";
            $params2['message'] = "Greetings user how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ";
            $params2['option'] = 0;
            $this->db->insertData("{{chats}}", $params2);
            $this->code = 1;
            $this->msg = "Successful";
            $params['password'] = $password;
            //$this->details = Yii::app()->createUrl('front/users-new', array('id' => $last_id, 'msg' => $this->msg)
            // );
        } else
            $this->msg = "Something went wrong cannot insert records";

        $this->jsonResponse();
    }

    public function actionaddMessage() {

        $params = $this->data;


        unset($params['action']);

        $params['id_user'] = Driver::getUserId();
        $params['date_sent'] = date('Y-m-d H:i:s');
        $params['sender'] = "user";
        if ($res = Driver::getLastChatByUser(Driver::getUserId())) {


            if ($res[0]['concluded'] == "1") {
                //level 1
                $params['option'] = 0;
                $params2['id_user'] = Driver::getUserId();
                $params2['date_sent'] = date('Y-m-d G:i:s');
                $params2['sender'] = "chatbot";
                $params2['message'] = "Greetings " . Driver::getUserName() . " how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ";
                $params2['option'] = 0;
                /* end level 1 */
            } else {
                //level 1
                if (($res[0]['option'] == "0") && (($params['message'] != "1") && ($params['message'] != "2") && ($params['message'] != "3"))) {
                    $params2['id_user'] = Driver::getUserId();
                    $params2['date_sent'] = date('Y-m-d H:i:s');
                    $params2['sender'] = "chatbot";
                    $params2['concluded'] = true;
                    $params2['message'] = "Sorry, not a valid answer, please try again";
                    $params2['option'] = 0;
                }
                /* end level 1 */
                //level 2
                if (($res[0]['option'] == "0") && (($params['message'] == "1"))) {
                    $params2['id_user'] = Driver::getUserId();
                    $params2['date_sent'] = date('Y-m-d H:i:s');
                    $params2['sender'] = "chatbot";
                    $params2['concluded'] = false;
                    $params2['message'] = "Please enter amount";
                    $params2['transaction_type'] = "deposit";
                    $params2['option'] = 1;
                } else if (($res[0]['option'] == "0") && (($params['message'] == "2"))) {
                    $params2['id_user'] = Driver::getUserId();
                    $params2['date_sent'] = date('Y-m-d H:i:s');
                    $params2['sender'] = "chatbot";
                    $params2['concluded'] = false;
                    $params2['message'] = "Please enter amount";
                    $params2['transaction_type'] = "withdraw";
                    $params2['option'] = 1;
                } else if (($res[0]['option'] == "0") && (($params['message'] == "3"))) {
                    $params2['id_user'] = Driver::getUserId();
                    $params2['date_sent'] = date('Y-m-d H:i:s');
                    $params2['sender'] = "chatbot";
                    $params2['concluded'] = true;
                    $user = Driver::getUserById(Driver::getUserId());
                    $params2['message'] = "Dear " . $user['name'] . " your balance to date is: " . $user['balance'] . " " . $user['currency'];
                    $params2['option'] = 0;
                }
                /* end level 2 */
                //level 3
                if (($res[0]['option'] == "1") && (is_numeric($params['message']))) {

                    $params2['id_user'] = Driver::getUserId();
                    $params2['date_sent'] = date('Y-m-d H:i:s');
                    $params2['sender'] = "chatbot";
                    $params2['concluded'] = false;
                    $params2['message'] = "Please enter currency from one from the following list <select class='currency'></select>";
                    $params2['option'] = 2;
                    $params2['transaction_type'] = $res[0]['transaction_type'];

                    $params2['amount'] = $params['message'];
                } else if (($res[0]['option'] == "1") && ($res[0]['transaction_type'] == "deposit") && (is_numeric($params['message'])) == false) {

                    $params2['id_user'] = Driver::getUserId();
                    $params2['date_sent'] = date('Y-m-d H:i:s');
                    $params2['sender'] = "chatbot";
                    $params2['concluded'] = true;
                    $params2['message'] = "Please enter a correct number to make the deposit, transaction aborted";
                    $params2['option'] = 0;
                } else if (($res[0]['option'] == "1") && ($res[0]['transaction_type'] == "withdraw") && (is_numeric($params['message'])) == false) {

                    $params2['id_user'] = Driver::getUserId();
                    $params2['date_sent'] = date('Y-m-d H:i:s');
                    $params2['sender'] = "chatbot";
                    $params2['concluded'] = true;
                    $params2['message'] = "Please enter a correct number to make the withdraw, transaction aborted";
                    $params2['option'] = 0;
                }
                /* end level 3 */
                // level 4
                if (($res[0]['option'] == "2") && ($res[0]['transaction_type'] == "deposit")) {
                    $amount = $res[0]['amount'];
                    $currency = $params['message'];
                    if ($this->isInList('1eea67f534f316bf888a1cfcbf0fa42e', $currency)) {
                        $resultCurrencyParameter = $this->rateCurrency('1eea67f534f316bf888a1cfcbf0fa42e', $currency);
                        $totalEuros = $amount * $resultCurrencyParameter;
                        $resultCurrencyMine = $this->rateCurrency('1eea67f534f316bf888a1cfcbf0fa42e', $_SESSION['chatapp']['currency']);
                        $total = $totalEuros / $resultCurrencyMine;
                        $params2['id_user'] = Driver::getUserId();
                        $params2['date_sent'] = date('Y-m-d H:i:s');
                        $params2['sender'] = "chatbot";
                        $params2['concluded'] = true;
                        $params2['message'] = "Amount " . $total . " " . $_SESSION['chatapp']['currency'] . " inserted on your account, thanks for using our app";
                        $params2['option'] = 3;

                        $params2['amount'] = $amount;

                        $user = Driver::getUserById(Driver::getUserId());
                        $paramUser['balance'] = $user['balance'] + $total;
                        $this->db->updateData("{{users}}", $paramUser, 'id', Driver::getUserId());
                    } else {
                        $params2['id_user'] = Driver::getUserId();
                        $params2['date_sent'] = date('Y-m-d H:i:s');
                        $params2['sender'] = "chatbot";
                        $params2['concluded'] = true;
                        $params2['message'] = "Currency " . $currency . " not found in service, transaction aborted";
                        $params2['option'] = 3;
                        $params2['amount'] = $amount;
                    }
                } else if (($res[0]['option'] == "2") && ($res[0]['transaction_type'] == "withdraw")) {
                    $amount = $res[0]['amount'];
                    $currency = $params['message'];
                    if ($this->isInList('1eea67f534f316bf888a1cfcbf0fa42e', $currency)) {
                        $resultCurrencyParameter = $this->rateCurrency('1eea67f534f316bf888a1cfcbf0fa42e', $currency);
                        $totalEuros = $amount * $resultCurrencyParameter;
                        $resultCurrencyMine = $this->rateCurrency('1eea67f534f316bf888a1cfcbf0fa42e', $_SESSION['chatapp']['currency']);
                        $total = $totalEuros / $resultCurrencyMine;
                        $user = Driver::getUserById(Driver::getUserId());
                        $params2['id_user'] = Driver::getUserId();
                        $params2['date_sent'] = date('Y-m-d H:i:s');
                        $params2['sender'] = "chatbot";
                        $params2['concluded'] = true;
                        $params2['option'] = 3;
                        $params2['amount'] = $amount;

                        if ($user['balance'] >= $total) {
                            $paramUser['balance'] = $user['balance'] - $total;
                            $this->db->updateData("{{users}}", $paramUser, 'id', Driver::getUserId());
                            $params2['message'] = "Amount " . $total . " " . $_SESSION['chatapp']['currency'] . " withdrew from your account, thanks for using our app";
                        } else {
                            $params2['message'] = "Amount to withdraw is greater than amount on user balance. Transaction aborted";
                        }
                    } else {
                        $params2['id_user'] = Driver::getUserId();
                        $params2['date_sent'] = date('Y-m-d H:i:s');
                        $params2['sender'] = "chatbot";
                        $params2['concluded'] = true;
                        $params2['message'] = "Currency " . $currency . " not found in service, transaction aborted";
                        $params2['option'] = 3;
                        $params2['amount'] = $amount;
                    }
                }
                /* end level 4 */
            }
            if ($this->db->insertData("{{chats}}", $params)) {
                $last_id = Yii::app()->db->getLastInsertID();
                $this->db->insertData("{{chats}}", $params2);
                $this->code = 1;
                $this->msg = "Successful";
                $this->details = Driver::getChatsByUser(Driver::getUserId());
            } else
                $this->msg = "Something went wrong cannot insert records";
        }



        $this->jsonResponse();
    }

    private function rateCurrency($access_key = '', $currency = '') {
        //$ch = curl_init();
        //curl_setopt($ch, CURLOPT_URL, "http://data.fixer.io/api/convert?access_key=" . $access_key . "&from=" . $from . "&to=" . $to . "&amount=" . $amount);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://data.fixer.io/api/latest?access_key=' . $access_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        curl_close($ch);
        $jsonArrayResponse = json_decode($result, true);
        return ($jsonArrayResponse["rates"][$currency]);
    }

    private function isInList($access_key = '', $currency = '') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://data.fixer.io/api/latest?access_key=' . $access_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        curl_close($ch);
        $jsonArrayResponse = json_decode($result, true);
        if ($jsonArrayResponse["rates"][$currency] == null)
            return false;
        else
            return true;
    }

}

/* end class*/