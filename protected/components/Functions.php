<?php

class Functions extends CApplicationComponent {

  





}

/* end class */

function t($message = '') {
    return Yii::t("default", $message);
}

function websiteUrl() {
    return Yii::app()->getBaseUrl(true);
}

function dump($data = '') {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
