<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

//use Yii;
//use yii\base\Component;
//namespace common\components;

class GeneralHelper {

    public function sanitize($value) {
        // sanitize array or string values
        if (is_array($value)) {
            array_walk_recursive($value, 'self::sanitize_value');
        } else {
            sanitize_value($value);
        }

        return $value;
    }

    //trim white space
    public function sanitize_value(&$value) {
        $value = trim(htmlspecialchars($value));
    }

    //To send multiple API requests without waiting for return value.
    //Mainly useful to avoid PHP mail delay
    public function multiRequest($data, $options = array()) {

        // array of curl handles
        $curly = array();
        // data to be returned
        $result = array();

        // multi handle
        $mh = curl_multi_init();

        // loop through $data and create curl handles
        // then add them to the multi-handle
        foreach ($data as $id => $d) {


            $curly[$id] = curl_init();

            $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
            curl_setopt($curly[$id], CURLOPT_URL, $url);
            curl_setopt($curly[$id], CURLOPT_HEADER, 0);
            curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);

            // post?
            if (is_array($d)) {
                if (!empty($d['post'])) {
                    curl_setopt($curly[$id], CURLOPT_POST, 1);
                    curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
                }
            }
            //Dont wait for the return value.
            curl_setopt($curly[$id], CURLOPT_TIMEOUT_MS, 50);
            // extra options?
            if (!empty($options)) {
                curl_setopt_array($curly[$id], $options);
            }

            curl_multi_add_handle($mh, $curly[$id]);
        }

        // execute the handles
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running > 0);


        // get content and remove handles
        foreach ($curly as $id => $c) {
            $result[$id] = curl_multi_getcontent($c);
            curl_multi_remove_handle($mh, $c);
        }

        // all done
        curl_multi_close($mh);

        return $result;
    }

    //Bulck push for android. Bulk Push is not possible in IOS
    //untested
    public function androidPush($deviceID, $pushmessage, $messageConfig = '') {
        if(is_array($deviceIDs)){
            $deviceIDs=$deviceID;
        }else{
            $deviceIDs=array($deviceID);
        }
        $headers = array(
            'Authorization: key=' . Yii::$app->params['androidPushAccessKey'],
            'Content-Type: application/json'
        );

        if (empty($messageConfig)) {
            $message = array(
                'title' => 'Project Name',
                'subtitle' => 'Android app Project Name',
                'vibrate' => 1,
                'sound' => 1,
                'largeIcon' => 'large_icon',
                'smallIcon' => 'small_icon'
            );
        } else {
            $message = $messageConfig;
        }
        $message['message'] = $pushmessage;
        $message['tickerText'] = $pushmessage;
        //split device ids in chunks of 1000, to keep it below limit.
        $deviceIDChunks = array_chunk($deviceIDs, 1000);
        foreach ($deviceIDChunks as $deviceIDChunk) {
            $fields = array(
                'registration_ids' => $deviceIDChunk,
                'data' => $message
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
        }
        return TRUE;
    }
    
    
    public function androidIosPush($deviceID, $pushmessage, $device_type, $user_type, $ioscustom_msg = NULL) {


        if ($device_type == 'Android') {

            $this->androidPush($deviceID, $pushmessage);
        } elseif ($device_type == 'IOS') {
            $this->iosPush($deviceID, $pushmessage, $user_type, $ioscustom_msg);
        } else {
            return true;
        }
    }

     public function iosPush($deviceID, $pushmessage, $user_type, $ioscustom_msg = NULL) {
        $passphrase = "alignminds";
//        print_r($user_type); die();
        ////////////////////////////////////////////////////////////////////////////////
        $errstr = "";
        $err = "";
        stream_context_set_option($ctx, 'ssl', 'local_cert', Yii::$app->basePath . Yii::$app->params['iosPushCertificate']);
        $ctx = stream_context_create();
        
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        //echo 'Connected to APNS' . PHP_EOL;
        // Create the payload body
        if (!empty($ioscustom_msg)) {
            $decode = json_decode($pushmessage, true);
            $body['aps'] = array(
                'alert' => $ioscustom_msg,
                'sound' => 'default',
                'custom_push_msg' => $decode,
            );
        } else {
            $body['aps'] = array(
                'alert' => $pushmessage,
                'sound' => 'default'
            );
        }

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceID) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result)
            echo 'Message not delivered' . PHP_EOL;
        else
        //echo 'Message successfully delivered' . PHP_EOL;
        // Close the connection to the server
            fclose($fp);
//        print_r($payload);
        return $result;
    }
    
    

}
