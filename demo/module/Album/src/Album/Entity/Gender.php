<?php
namespace Album\Entity;
use Doctrine\Common\Collections\ArrayCollections;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Gender{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
   
    /** @ORM\Column(type="string") */
    protected $gender_name;
	
	/**
	* @ORM\OneToMany(targetEntity="User", mappedBy="Gender")
	**/
	protected $genders;

    function getGender_name() {
       return $this->gender_name;
    }

    function setGender_name($value) {
       $this->gender_name = $value;
    }

    public function getGender()
    {
        return $this->genders;
    }

    public function setGender($value)
    {
        $this->genders = $value;
    }
}