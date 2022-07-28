<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of sendSMS
 *
 * @author dinethwasukajayasekera
 */
class sendSMS {

    function __construct() {

        $settings = array();

        $settings['campaignName'] = "LEOS OF CH";

        $settings['apiSmsSend'] = "https://bsms.hutch.lk/api/sendsms";
        $settings['apiSmsLogin'] = "https://bsms.hutch.lk/api/login";

        $settings['username'] = "sachin.nasasigns@gmail.com";
        $settings['password'] = "Alpha@123";
        $settings['accesstoken'] = "";
        $settings['refreshToken'] = "";
        $settings['masking'] = "CMB HEROES";

        $this->settings = $settings;
    }

    private function loginSMS() {

        // DATA JASON ENCODED
        $data = array(
            "username" => $this->settings['username'],
            "password" => $this->settings['password']
        );
        $data_json = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->settings['apiSmsLogin']);

        curl_setopt($ch, CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'X-API-VERSION: v1',
                )
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // DATA ARRAY
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $response = json_decode($result);
        curl_close($ch);

        if (isset($response->accessToken)) {
            $this->settings['accesstoken'] = $response->accessToken;
            return 1;
            exit;
        } else {
            return $response->error;
            exit;
        }
    }

    function send($numbers, $message) {

        $data = array(
            "campaignName" => $this->settings['campaignName'],
            "mask" => $this->settings['masking'],
            "numbers" => $numbers,
            "content" => $message
        );
        $data_json = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->settings['apiSmsSend']);

        curl_setopt($ch, CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'X-API-VERSION: v1',
                    'Authorization: Bearer ' . $this->settings['accesstoken']
                )
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // DATA ARRAY
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $response = json_decode($result);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response->status == "401BAD_REQUEST") {

            $refresh = $this->loginSMS();

            if ($refresh == 1) {

                $smsData = $this->send($numbers, $message);
                return $smsData;
                exit;
            } else {
                return $refresh;

                exit;
            }
        } else {
            return "done";
            exit;
        }
    }

}
