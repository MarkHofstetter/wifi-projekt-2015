<?php
namespace Album\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Gender{
   

    /** @ORM\Column(type="string") */
    protected $gender_name;
	
	 /**
	*@OneToMany(targetEntity="User", mappedBy="Gender")
	* @JoinColumn(name="id", referencedColumnName="gender_id")
	*/
	protected $gender;
	

    function getGender_name() {
       return $this->gender_name;
    }

    function setGender_name($value) {
       $this->gender_name = $value;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($value)
    {
        $this->gender = $value;
    }
}