<?php

    namespace App;

use DateTime;

    class Helpers
    {
        public static function valid_google_captcha($captcha_response)
        {
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.env("CAPTCHA_SECRET_KEY").'&response='.$captcha_response);
            $responseData = json_decode($verifyResponse);
            return $responseData->success;
        }

        public static function date_diff($date1, $date2)
        {
            $date11 = strtotime($date1);
            $date22 = strtotime($date2);

            $difference = $date22 - $date11;
            if($difference > 0){
                $earlier = $date1;
                $later = $date2;
            }else{
                $earlier = $date2;
                $later = $date1;
            }
            $earlierDateObj = new DateTime($earlier);
            $laterDateObj = new DateTime($later);
            $dateDifference = $earlierDateObj->diff($laterDateObj);
            $dateDifference2 = date_diff($earlierDateObj, $laterDateObj);

            // $days = floor($difference / (60 * 60 * 24));
            // $months = floor($days / 30);
            // $years = floor($months / 12);
        }
    }








?>