<?php

    namespace App;

    class Helpers
    {
        public static function valid_google_captcha($captcha_response)
        {
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.env("CAPTCHA_SECRET_KEY").'&response='.$captcha_response);
            $responseData = json_decode($verifyResponse);
            return $responseData->success;
        }
    }








?>