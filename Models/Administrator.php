<?php  namespace Models;

class Administrator{

    private $id;
    private $password;
    private $username;

    Public function __construct(/*$id,*/ $password, $username){
        //$this->$id= $id;
        $this->$password= $password;
        $this->$username= $username;
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

    public function getPassWord()
    {
        return $this->password;
    }

    public function setPassWord($password)
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
        return "<br>username: ".$this->username.
               "<br>ID: ".$this->id;
    }
}







?>