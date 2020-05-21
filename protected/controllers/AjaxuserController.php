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

        if ($res =Driver::getUserByEmail($this->data['email'])) {
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
            $this->code = 1;
            $this->msg = "Successful";
            $params['password'] = $password;
            //$this->details = Yii::app()->createUrl('front/users-new', array('id' => $last_id, 'msg' => $this->msg)
            // );
        } else
            $this->msg = "Something went wrong cannot insert records";

        $this->jsonResponse();
    }

}

/* end class*/