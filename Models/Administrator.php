<?php  namespace Models;

class Administrator{

    private $adminId;
    private $userName;
    private $password;

    Public function __construct($userName, $password){
        $this->userName= $userName;
        $this->password= $password;
    }

    public function getAdministratorId()
    {
        return $this->adminId;
    }

    public function setAdministratorId($adminId)
    {
        $this->adminId = $adminId;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    public function __tostring(){
        return "<br>ID: ".$this->adminId.
               "<br>Username: ".$this->userName.
               "<br>Password: ".$this->password;
               
    }
}







?>