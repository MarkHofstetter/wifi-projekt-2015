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

    function getFullName() {
       return $this->fullName;
    }

    function setFullName($value) {
       $this->fullName = $value;
    }

    function getId() {
    	return $this->id;
    }
}