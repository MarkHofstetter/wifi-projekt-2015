<?php
namespace Album\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class User {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $fullName;
	
    
	
	// /**
	// * @ManyToOne(targetEntity="Gender")
    //  * @JoinColumn(name="gender_id", referencedColumnName="id")
	// */
	
	
	
	protected $gender;

    function getFullName() {
       return $this->fullName;
    }

    function setFullName($value) {
       $this->fullName = $value;
    }
	
	function getGender() {
       return $this->gender;
    }

    function setGender($value) {
       $this->gender = $value;
    }

    function getId() {
    	return $this->id;
    }
}