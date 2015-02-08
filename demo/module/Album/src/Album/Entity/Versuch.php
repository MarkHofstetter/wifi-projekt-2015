<?php
namespace Album\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Versuch {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $karnickel;
	


    function getKarnickel() {
       return $this->Karnickel;
    }

    function setKarnickel($value) {
       $this->Karnickel = $value;
    }


    function getId() {
    	return $this->id;
    }
}