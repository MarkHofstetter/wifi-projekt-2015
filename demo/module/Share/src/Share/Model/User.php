<?php
namespace Share\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class User implements InputFilterAwareInterface
{
    public $id;
	public $trusts;
    public $first_name;
    public $last_name;
	public $gender;
	public $email;
	public $username;
	public $password;
	public $admin;
    protected $Entity;
	protected $inputFilter;

	function __construct($ae) {
	  if (empty($ae)) {
	     return;
	  }	
	  $this->id = $ae->getId();
	  //$this->trusts = $ae->getTrusts()->getMyFriend();
	  $this->first_name = $ae->getFirstName();
      $this->last_name = $ae->getLastName(); 
	  $this->gender = $ae->getGender(); 
	$this->email = $ae->getEmail(); 
	  $this->username = $ae->getUserName(); 
	  $this->password = $ae->getPassWord(); 
	  $this->admin = $ae->getAdmin();
	  $this->Entity = $ae;
	}
	
	function getEntity() {	   
	//$this->Entity->setTrusts($this->trusts);
	   $this->Entity->setFirstName($this->first_name);
       $this->Entity->setLastName($this->last_name);
	   $this->Entity->setGender($this->gender);
	    $this->Entity->setEmail($this->email);
		$this->Entity->setUserName($this->username);
		$this->Entity->setPassWord($this->password);
		$this->Entity->setAdmin($this->admin);
	   return $this->Entity;
    }	   
	
	
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id']))     ? $data['id']     : null;
		$this->trusts = (isset($data['trusts'])) ? $data['trusts'] : null;
        $this->first_name = (isset($data['first_name'])) ? $data['first_name'] : null;
        $this->last_name  = (isset($data['last_name']))  ? $data['last_name']  : null;
		 $this->gender  = (isset($data['gender']))  ? $data['gender']  : null;
		 $this->email  = (isset($data['email']))  ? $data['email']  : null;
		 $this->username  = (isset($data['username']))  ? $data['username']  : null;
		 $this->password  = (isset($data['password']))  ? $data['password']  : null;
		 $this->admin  = (isset($data['admin']))  ? $data['admin']  : null;
    }
	
	/*
    public function exchangeArray($data)
    {
        $this->id     = (isset($data->getId()))     ? $data->getId()     : null;
        $this->artist = (isset($data->getArtist())) ? $data->getArtist() : null;
        $this->title  = (isset($data->getTitle()))  ? $data->getTitle()  : null;
    }
    */
	/*
	public function exchangeArray($data)
    {
        $this->setId($data['id']);
        $this->setArtist($data['artist']);
        $this->setTitle($data['title']);
    }
	*/
     // Add the following method:
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'first_name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'last_name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));
			
			$inputFilter->add(array(
                'name'     => 'gender',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 1,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
