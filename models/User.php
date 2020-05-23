<?php



class User{
    private $sessionName;
    private $userId;
    private $version;
    private $vtigerVersion;

    public function __construct() {}
    
    public function setAllData(array $data = []){
        foreach($data AS $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function __toString () {
        return "{'sessionName': '$this->sessionName', 'userId': '$this->userId', 
            'version':'$this->version', 'vtigerVersion': '$this->vtigerVersion'}";
    }

    public function getSessionName () {
        return $this->sessionName;
    }

    public function setSessionName (string $sessionName) {
        $this->sessionName = $sessionName;
    }

    public function getUserId () {
        return $this->userId;
    }

    public function setUserId (string $userId) {
        $this->userId = $userId;
    }

    public function getVersion () {
        return $this->version;
    }

    public function setVersion (string $version) {
        $this->version = $version;
    }

    public function getVtigerVersion () {
        return $this->vtigerVersion;
    }

    public function setVtigerVersion (string $vtigerVersion) {
        $this->vtigerVersion = $vtigerVersion;
    }
}