<?php
namespace Share\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity @ORM\Table(name="Users") */


class User {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
	

    /** @ORM\Column(type="string", nullable=false) */
    protected $first_name;
	
	  /** @ORM\Column(type="string", nullable=false) */
    protected $last_name;
	
	  /** @ORM\Column(type="string") */
    protected $gender;
	
		  /** @ORM\Column(type="string", unique=true, nullable=false) */
    protected $username;
	
	/** @ORM\Column(type="string", nullable=false) */
    protected $password;
	
	/** @ORM\Column(type="string", unique=true, nullable=false) */
    protected $email;
	
	/** @ORM\Column(type="integer") */
    protected $admin;
	
	
	/**
	* @ORM\OneToMany(targetEntity="Product", mappedBy="User")
	**/
	protected $product_users;
	
	/**
	* @ORM\OneToMany(targetEntity="Trust", mappedBy="User")
	**/
	protected $trust_users;
	
	/**
	* @ORM\OneToMany(targetEntity="Trust", mappedBy="User")
	**/
	protected $trusts;
	
	/**
	* @ORM\OneToMany(targetEntity="Lend", mappedBy="User")
	**/
	protected $lend_users;

	public function getProductUsers()
    {
        return $this->product_users;
    }

    public function setProductUsers($value)
    {
        $this->product_users = $value;
    }
	
	public function getTrustUsers()
    {
        return $this->trust_users;
    }

    public function setTrustUsers($value)
    {
        $this->trust_users = $value;
    }
	
	public function getTrusts()
    {
        return $this->trusts;
    }

    public function setTrusts($value)
    {
        $this->trusts = $value;
    }

	public function getLendUsers()
    {
        return $this->lend_users;
    }

    public function setLendUsers($value)
    {
        $this->lend_users = $value;
    }

    function getFirstName() {
       return $this->first_name;
    }

    function setFirstName($value) {
       $this->first_name = $value;
    }

    function getLastName() {
       return $this->last_name;
    }

    function setLastName($value) {
       $this->last_name= $value;
    }
	
	
	function getGender() {
       return $this->gender;
    }

    function setGender($value) {
       $this->gender= $value;
    }
	
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
	 
	   function getEmail() {
       return $this->email;
    }

    function setEmail($value) {
       $this->email = $value;
    }
    
	function getAdmin() {
       return $this->admin;
    }

    function setAdmin($value) {
       $this->admin = $value;
    }



    function getId() {
    	return $this->id;
    }
}