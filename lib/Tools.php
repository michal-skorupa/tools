<?php

namespace Tools;

class Tools
{
    public static function logger($fileName, $data, $method = false, $idCustomer = false)
    {
        $log['date'] = date('Y-m-d H:i:s');
        $log['body'] = $data;
        if ($method)
            $log['method'] = $method;
        if ($idCustomer) {
            $log['idCustomer'] = $idCustomer;
            $idCustomer = '_' . $idCustomer;
        }

        file_put_contents(__DIR__ . '/../../log/' . $fileName . $idCustomer . '.log', print_r($log, true), FILE_APPEND);
    }

    public static function error($fileName, $data)
    {
        file_put_contents(__DIR__ . '/../../log/' . $fileName . '.log', date('Y-m-d H:i:s') . ' ' . print_r($data, true) . PHP_EOL, FILE_APPEND);
    }

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
}