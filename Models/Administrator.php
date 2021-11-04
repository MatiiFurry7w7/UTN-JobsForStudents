<?php  namespace Models;

class Administrator{

    private $adminId;
    private $Email;
    private $password;

    /*Public function __construct($Email, $password){
        $this->Email= $Email;
        $this->password= $password;
    }*/

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

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;

        return $this;
    }

    public function __tostring(){
        return "<br>ID: ".$this->adminId.
               "<br>Email: ".$this->Email.
               "<br>Password: ".$this->password;
               
    }
}







?>