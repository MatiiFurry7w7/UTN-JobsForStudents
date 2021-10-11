<?php  namespace Models;

class Administrator{

    private $id;
    private $password;
    private $username;

    Public function __construct($id, $password, $username){
        $this->$id= $id;
        $this->$password= $password;
        $this->$username= $username;
    }

    public function getid()
    {
        return $this->id;
    }

    public function setid($id)
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
        return "<br>username: ".$this->username.
               "<br>ID: ".$this->id;
    }
}







?>