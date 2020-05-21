<?php

class ScriptManageUser {

    public static function scripts() {
        $ajaxurl = Yii::app()->baseUrl . '/ajaxUser';
        $site_url = Yii::app()->baseUrl . '/';
        $home_url = Yii::app()->baseUrl . '/user';
        $website_url = Yii::app()->getBaseUrl(true);

        Yii::app()->clientScript->scriptMap = array(
            'jquery.js' => false,
            'jquery.min.js' => false
        );

        $cs = Yii::app()->getClientScript();
        $cs->registerScript(
                'ajaxurl', "var ajax_url='$ajaxurl';", CClientScript::POS_HEAD
        );
        $cs->registerScript(
                'site_url', "var site_url='$site_url';", CClientScript::POS_HEAD
        );
        $cs->registerScript(
                'home_url', "var home_url='$home_url';", CClientScript::POS_HEAD
        );

        $cs->registerScript(
                'website_url', "var website_url='$website_url';", CClientScript::POS_HEAD
        );



        /** END Set general settings */
        /* JS FILE */
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->baseUrl . '/assets/jquery-1.10.2.min.js',
//                Yii::app()->baseUrl . '/assets/jQuery-3.4.1.js', 
                CClientScript::POS_END
        );

        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->baseUrl . '/assets/bootstrap/js/bootstrap.min.js', CClientScript::POS_END
        );

        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->baseUrl . '/assets/chosen/chosen.jquery.min.js', CClientScript::POS_END
        );


        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->baseUrl . '/assets/form-validator/jquery.form-validator.min.js', CClientScript::POS_END
        );

        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->baseUrl . '/assets/nprogress/nprogress.js', CClientScript::POS_END
        );

        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->baseUrl . '/assets/sweetalert/sweetalert2.js', CClientScript::POS_END
        );

        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->baseUrl . '/assets/app.js?ver=1.0', CClientScript::POS_END
        );

        /* CSS FILE */
        $baseUrl = Yii::app()->baseUrl . "";
        $cs = Yii::app()->getClientScript();
        // $cs->registerCssFile("//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css");		
        $cs->registerCssFile($baseUrl . "/assets/bootstrap/css/bootstrap.min.css");

        $cs->registerCssFile($baseUrl . "/assets/chosen/chosen.min.css");
        $cs->registerCssFile($baseUrl . "/assets/animate.css");

        $cs->registerCssFile("//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css");
        $cs->registerCssFile("//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css");

        $cs->registerCssFile($baseUrl . "/assets/nprogress/nprogress.css");
        $cs->registerCssFile($baseUrl . "/assets/style.css?ver=1.0");

        $cs->registerCssFile($baseUrl . "/assets/app-responsive.css?ver=1.0");

        $cs->registerCssFile($baseUrl . "/assets/sweetalert/sweetalert2.css");
    }

}

/*END CLASS*/