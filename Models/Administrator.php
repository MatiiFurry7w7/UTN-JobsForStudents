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

    public function getpassword()
    {
        return $this->password;
    }

    public function setpassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getusername()
    {
        return $this->username;
    }

    public function setusername($username)
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