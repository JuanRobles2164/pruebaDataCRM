<?php

require_once('../models/User.php');
require_once('../models/Token.php');

class MainController{
    private $tokenData;
    private $usuario;
    private static $url =  "https://developold.datacrm.la/datacrm/pruebatecnica/webservice.php";

    private function printJson(array $data){
        foreach($data as $value){
            echo $value;
            echo '<br>';
        }
    }

    public function getLogin($parameters){
        $this->getChallenge($parameters);
        $this->postLogin();
        
    }

    private function getChallenge($parameters){
        $operation = http_build_query($parameters);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, self::$url.'?'.$operation);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $dataReturned = json_decode(curl_exec($ch), true);
        if($dataReturned['success']){
            $this->tokenData = new Token;
            $this->tokenData->setAllValues($dataReturned['result']);
            echo '<br>';
        }else{
            $this->printJson($dataReturned['error']);
        }
        curl_close($ch);
    }
    private function postLogin(){
        
        $fields = [
            'accessKey' => md5($this->tokenData->getToken().'9zIDkLTMWtSMmlnh'),
            'operation' => 'login', 
            'username' => 'prueba'
        ];
        $parameters = http_build_query($fields);
        $finalUrl = self::$url.'?'.$parameters;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded"));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
        if($result['success']){
            $this->usuario = new User;
            $this->usuario->setAllData($result['result']);
        }else{
            $this->printJson($result['error']);
        }
        
    }
    public function execQuery(){
        $query = 'select * from Contacts;';
        $parameters = [
            'operation' => 'query',
            'sessionName' => $this->usuario->getSessionName(),
            'query' => $query
        ];
        $operation = http_build_query($parameters);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, self::$url.'?'.$operation);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch), true);
        if(!$result['success']){
            $this->printJson($result['error']);
        }
        return $result['result'];
    }
}