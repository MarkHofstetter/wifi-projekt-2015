<?php
namespace Share\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity @ORM\Table(name="Users") */


class Login extends User{
    
    protected $id;
    protected $username;
    protected $password;
	
	
	
	function getUserName() {
       return $this->username;
    }
	
	 function setUserName($value) {
       $this->username = $value;
    }

    function setPassWord($value) {
	   $this->password = sha1($value);
    }
	
	function getPassWord() {
       return $this->password;
	 }

    function getId() {
    	return $this->id;
    }
}