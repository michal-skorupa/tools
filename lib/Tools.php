<?php

namespace Tools;

/**
 * Class Tools
 * @package Tools
 */
class Tools
{
    public static function dump($die, $variable, $desc = false, $noHtml = false)
    {
        if (is_string($variable)) {
            $variable = str_replace("<_new_line_>", "<BR>", $variable);
        }

        if ($noHtml) {
            echo "\n";
        } else {
            echo "<pre>";
        }

        if ($desc) {
            echo $desc . ": ";
        }

        print_r($variable);

        if ($noHtml) {
            echo "";
        } else {
            echo "</pre>";
        }

        if ($die) {
            die();
        }
    }

    public static function apiResponse($message, $code, $data = false, $errorCode = false)
    {
        $array = [];
        $array['message'] = $message;
        $array['code'] = $code;
        if ($data) {
            $array['data'] = (array)$data;
        }
        if ($errorCode) {
            $array['error'] = $errorCode;
        }
        return json_encode($array);
    }

    /**
     * @param string $email
     * @return boolean
     */
    public static function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $mobileNumber
     * @return boolean
     */
    public static function validateMobile($mobileNumber)
    {
        return preg_match('/^[\+0-9\-\(\)\s]*$/', $mobileNumber);
    }

    /**
     * @param $string
     * @return mixed|string
     */
    public static function urlsafe_b64encode($string)
    {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }

    /**
     * @param $string
     * @return string
     */
    public static function urlsafe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    /**
     * @param array $array
     * @return bool
     */
    static public function isNumericArray(&$array)
    {
        if (!is_array($array)) {
            return false;
        }
        $keys = array_keys($array);
        return (array_keys($keys) === $keys);
    }

    /**
     * @param integer $time
     * @return string
     */
    public static function prepareVisitTime($time)
    {
        return gmdate('H:i:s', $time);
    }

    /**
     * @param $email
     * @return bool|string
     */
    public static function getDomainFromEmail($email)
    {
        // Get the data after the @ sign
        return substr(strrchr($email, "@"), 1);
    }
}