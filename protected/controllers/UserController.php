<?php

if (!isset($_SESSION)) {
    session_start();
}

class UserController extends CController {

    public $layout = 'layout';
    public $body_class = '';

    public function init() {
        
    }

    public function beforeAction($action) {
        /* if (Yii::app()->controller->module->require_login){
          if(! DriverModule::islogin() ){
          $this->redirect(Yii::app()->createUrl('/admin/noaccess'));
          Yii::app()->end();
          }
          } */
        $action_name = $action->id;
        $accept_controller = array('login', 'ajax');
        $external_controller = array('register','chat');
        if (!Driver::islogin()) {
            if (!in_array($action_name, $external_controller)) {
                if (!in_array($action_name, $accept_controller)) {
                    $this->redirect(Yii::app()->createUrl('/user/login'));
                }
            }
        }


        ScriptManageUser::scripts();

        $cs = Yii::app()->getClientScript();

        return true;
    }

    public function actionLogin() {

        $encryption_type = Yii::app()->params->encryption_type;
        if (empty($encryption_type)) {
            $encryption_type = 'yii';
        }

//        if (Driver::islogin()) {
//            $this->redirect(Yii::app()->createUrl('/user'));
//            Yii::app()->end();
//        }

        $this->body_class = 'login-body';

        /* unset(Yii::app()->request->cookies['kt_username']);
          unset(Yii::app()->request->cookies['kt_password']); */

        $kt_username = isset(Yii::app()->request->cookies['kt_username']) ? Yii::app()->request->cookies['kt_username']->value : '';
        $kt_password = isset(Yii::app()->request->cookies['kt_password']) ? Yii::app()->request->cookies['kt_password']->value : '';

        if ($encryption_type == "yii") {
            if (!empty($kt_password) && !empty($kt_username)) {
                $kt_password = Yii::app()->securityManager->decrypt($kt_password);
            }
        } else
            $kt_password = '';

        $this->render('login', array(
            'email' => $kt_username,
            'password' => $kt_password
        ));
    }

    public function actionRegister() {
       
       
        $this->render('register', array(
            'email_address' => isset($_GET['email']) ? $_GET['email'] : ''
        ));
    }
    
      public function actionChat() {
       
        $this->render('chat', array(
        ));
    }

    public function actionLogout() {
        unset($_SESSION['chatapp']);
        $this->redirect(Yii::app()->createUrl('/user/login'));
    }

    public function actionIndex() {
        $this->body_class = "dashboard";
        $this->render('dashboard');
    }

    public function actionDashboard() {
        $this->body_class = "dashboard";
        $this->render('dashboard');
    }

}

/* end class*/