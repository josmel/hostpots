<?php namespace App\Services;

use Config;

class PushNotification {
    
    protected $_androidApiKey;
    protected $_iospem;
    protected $_iospass;
    
    public function __construct() 
    {
        $this->_androidApiKey = Config::get('pushnotification.android.api');
        $this->_iospem = Config::get('pushnotification.ios.pem');
        $this->_iospass = Config::get('pushnotification.ios.pass');
    }

    public function android(array $id, $message, array $params = array(), $typePush = 'alert') {
        $data = array_merge(array("message" => $message), $params);
        $fields = array(
            'registration_ids' => $id,
            'data' => $data,
        );
        $headers = array(
            "Authorization: key={$this->_androidApiKey}",
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, Config::get('pushnotification.android.url'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return false;
        }
        curl_close($ch);
        return true;
    }

    public function ios(array $app, $message, array $params = array(), $typePush = 'alert') {
        $context = stream_context_create();
        stream_context_set_option($context, 'ssl', 'local_cert', $this->_iospem);
        stream_context_set_option($context, 'ssl', 'passphrase', $this->_iospass);
        $err = null;
        $errstr = null;
        $socket = stream_socket_client(Config::get('pushnotification.ios.sandbox'), $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $context);
        if (!$socket) {
            return false;
        }
        $payload['aps'] = array_merge(array('alert' => $message), $params);
        if(strtolower($typePush)=='alert'){
            $payload['aps'] = array_merge(array('alert' => $message), $params);
        }elseif(strtolower($typePush)=='silent'){
            $silent = array('silentmsg' => $message);//investigar un poco mas sobre esto
            $payloadType = array_merge(array('content-available' =>1,'sound'=>0), $silent);
            $payload['aps'] = array_merge($payloadType,$params);
        }
        $payloadJSON = json_encode($payload);
            foreach ($app as $token) {
                $deviceToken = $token;
                $payloadServer = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payloadJSON)) . $payloadJSON;
                $result = fwrite($socket, $payloadServer, strlen($payloadServer));
            }
        if (!$result) {
            return false;
        }
        fclose($socket);
        return true;
    }
    
    public function setAndroidApiKey($apikey)
    {
        $this->_androidApi = $apikey;
    }
    
    public function setIosPem($pem)
    {
        $this->_iospem = $pem;
    }
    
    public function setIosPass($pass)
    {
        $this->_iospass = $pass;
    }

}