<?php  namespace Models;

class Administrator{

    private $id;
    private $password;
    private $username;

    Public function __construct($username, $password){
        $this->password= $password;
        $this->username= $username;
    }

    public function getAdministratorId()
    {
        return $this->id;
    }

    public function setAdministratorId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setpPssword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getUserName()
    {
        return $this->username;
    }

    public function setUserName($username)
    {
        $this->username = $username;

        return $this;
    }

    public function __tostring(){
        return "<br>Username: ".$this->username.
               "<br>Password: ".$this->password.
               "<br>ID: ".$this->id;
    }
}







?>