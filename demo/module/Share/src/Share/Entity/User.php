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


    /** @ORM\Column(type="string") */
    protected $first_name;
	
	  /** @ORM\Column(type="string") */
    protected $last_name;
	
	  /** @ORM\Column(type="string") */
    protected $gender;
	
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

    function getId() {
    	return $this->id;
    }
}