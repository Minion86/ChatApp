<?php

return array(
    'name' => 'Trabajo al Paso',
    'defaultController' => 'user',
    'import' => array(
        'application.models.*',
        'application.models.admin.*',
        'application.components.*',
        'application.vendor.*',
    ),
    'language' => 'en',
    'params' => array(
        //'encryption_type'=>"yii",
        'encryption_type' => "md5",
    ),
    'components' => array(
        'urlManager' => array(
            'class' => 'UrlManager',
            'urlFormat' => 'path',
            //'urlSuffix'=>'.html',
            //'enablePrettyUrl' => true,
            'showScriptName' => false,
            'caseSensitive' => false,
            'rules' => array(
                '/' => array('/user/login/'),
                '/user/' => array('/user/login/'),
                '<_c:(user)>' => '<_c>/login',
                'lang/*' => 'user/login',
                '<lang:\w+>/<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            )
        ),
        'db' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=chatapp',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'kt_',
//            'class' => 'CDbConnection',
//            'connectionString' => 'mysql:host=db5000475351.hosting-data.io;dbname=dbs455511',
//            'emulatePrepare' => true,
//            'username' => 'dbu793240',
//            'password' => 'Info.2010.$',
//            'charset' => 'utf8',
//            'tablePrefix' => 'kt_',
            
        ),
        'functions' => array(
            'class' => 'Functions'
        ),
        'validator' => array(
            'class' => 'Validator'
        )
    ),
);
