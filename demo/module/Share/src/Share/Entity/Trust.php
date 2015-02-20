<?php
namespace Share\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity @ORM\Table(name="Trust") */
class Trust {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

	
	
	/**
	* @ORM\ManyToOne(targetEntity="Users")
	**/
	protected $me;
	
	/**
	* @ORM\ManyToOne(targetEntity="Users")
	**/
	protected $myfriend;

    
	function getMe() {
       return $this->me;
    }

    function setMe($value) {
       $this->me = $value;
    }
	
	function getMyFriend() {
       return $this->myfriend;
    }

    function setMyFriend($value) {
       $this->myfriend = $value;
    }
	
    function getId() {
    	return $this->id;
    }
}