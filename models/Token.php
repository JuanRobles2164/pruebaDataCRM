<?php

class Token {
    protected $token;
    protected $serverTime;
    protected $expireTime;

    public function __construct()
    {
        
    }
    public function __toString()
    {
        $dataString = 
        "
        {'token':$this->token, 
            'serverTime' : $this->serverTime, 
            'expireTime':$this->expireTime
        }";
        return $dataString;
    }
    public function setAllValues(array $data = []){
        foreach($data as $attribute => $value)
        {
            $this->{$attribute} = $value;
        }
    }
    public function setToken($token){
        $this->token = $token;
    }
    public function getToken() : string
    {
        return $this->token;
    }
    public function setServerTime($serverTime){
        $this->serverTime = $serverTime;
    }
    public function getServerTime(){
        return $this->serverTime;
    }
    public function setExpireTime($expireTime){
        $this->expireTime = $expireTime;
    }
    public function getExpireTime(){
        return $this->expireTime;
    }
}