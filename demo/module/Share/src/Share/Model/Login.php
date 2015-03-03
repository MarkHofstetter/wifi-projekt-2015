<?php
namespace Share\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Login implements InputFilterAwareInterface
{
    public $id;
	public $username;
	public $password;
    protected $Entity;
	protected $inputFilter;

	function __construct($ae) {
	  if (empty($ae)) {
	     return;
	  }	
	  $this->id = $ae->getId();
	  
	  $this->username = $ae->getUserName(); 
	  $this->password = $ae->getPassWord(); 

	  $this->Entity = $ae;
	}
	
	function getEntity() {	   

		$this->Entity->setUserName($this->username);
		$this->Entity->setPassWord($this->password);

	   return $this->Entity;
    }	   
	
	
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id']))     ? $data['id']     : null;
		 $this->username  = (isset($data['username']))  ? $data['username']  : null;
		 $this->password  = (isset($data['password']))  ? $data['password']  : null;

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
                'name'     => 'username',
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
                            'max'      => 10,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'password',
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
                            'max'      => 10,
                        ),
                    ),
                ),
            ));
			
			

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
