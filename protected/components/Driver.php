<?php

class Driver {

    static $message;

    public static function assetsUrl() {
        return Yii::app()->baseUrl . '/assets';
    }

    public static function q($data) {
        return Yii::app()->db->quoteValue($data);
    }

    public static function islogin() {
        if (isset($_SESSION['chatapp'])) {
            if (is_numeric($_SESSION['chatapp']['id'])) {
                return true;
            }
        }
        return false;
    }

    public static function getLoginType() {
        return false;
    }

    public static function getUserType() {
        return false;
    }

    public static function getUserId() {
        if (self::islogin()) {
            return $_SESSION['chatapp']['id'];
        }
        return false;
    }

    public static function getUserName() {
        if (self::islogin()) {
            return $_SESSION['chatapp']['name'];
        }
        return false;
    }

    public static function moduleUrl() {
        return Yii::app()->getBaseUrl(true);
    }

    public static function getUserByEmail($email = '') {
        $db = new DbExt;
        $stmt = "SELECT * FROM
		{{users}}
		WHERE
		email=" . self::q($email) . "
		LIMIT 0,1
		";
        if ($res = $db->rst($stmt)) {
            return $res[0];
        }
        return false;
    }

    public static function getUserById($id = 0) {
        $db = new DbExt;
        $stmt = "SELECT * FROM
		{{users}}
		WHERE
		id=" . self::q($id) . "
		LIMIT 0,1
		";
        if ($res = $db->rst($stmt)) {
            return $res[0];
        }
        return false;
    }

    public static function getChatsByUser($id = 0) {
        $db = new DbExt;
        $stmt = "SELECT * FROM
		{{chats}}
		WHERE
		id_user=" . self::q($id) . "
		";
        if ($res = $db->rst($stmt)) {
            return $res;
        }
        return false;
    }

    public static function getLastChatByUser($id = 0) {
        $db = new DbExt;
        $stmt = "SELECT * FROM
		{{chats}}
		WHERE
		id_user=" . self::q($id) . "
                order by id desc    
		LIMIT 0,1";
        if ($res = $db->rst($stmt)) {
            return $res;
        }
        return false;
    }

    public static function LoginUser($email = '', $password = '') {
        $encryption_type = Yii::app()->params->encryption_type;
        if (empty($encryption_type)) {
            $encryption_type = 'yii';
        }

        $db = new DbExt;
        $stmt = "
		SELECT * FROM
		{{users}}
		WHERE
		email=" . self::q($email) . "		
		LIMIT 0,1
		";
        if ($res = $db->rst($stmt)) {
            $data = $res[0];
            $hash = $data['password'];
            if ($encryption_type == "yii") {
                if (CPasswordHelper::verifyPassword($password, $hash)) {
                    return $data;
                }
            } else {
                if (md5($password) == $hash) {
                    return $data;
                }
            }
        }
        return false;
    }

    public static function cleanText($text = '') {
        return stripslashes($text);
    }

    public static function hasModuleAddon($modulename = '') {
        if (Yii::app()->hasModule($modulename)) {
            $path_to_upload = Yii::getPathOfAlias('webroot') . "/protected/modules/$modulename";
            if (file_exists($path_to_upload)) {
                return true;
            }
        }
        return false;
    }

    public static function t($message = '') {
        return Yii::t("default", $message);
    }

    public static function Curl($uri = "", $post = "") {
        $error_no = '';
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $resutl = curl_exec($ch);

        if ($error_no == 0) {
            return $resutl;
        } else
            return false;
        curl_close($ch);
    }

    public static function dateNow() {
        return date('Y-m-d G:i:s');
    }

    public static function getHostURL() {
        return "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'];
    }

}

/* end class*/
