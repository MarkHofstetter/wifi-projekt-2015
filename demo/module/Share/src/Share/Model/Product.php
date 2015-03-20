<?php
namespace Share\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Product implements InputFilterAwareInterface
{
    public $id;
    public $title;
    public $description;
	public $owner;
	public $picture;
    protected $owner_id;
	protected $Entity;
	protected $inputFilter;

	function __construct($ae) {
	  if (empty($ae)) {
	     return;
	  }	
	  $this->id = $ae->getId();
	  $this->owner_id = $ae->getOwner()->getId();
	  $this->title = $ae->getTitle();
      $this->description = $ae->getDescription(); 
	  $this->ownername = $ae->getOwner()->getFirstName() .' '. $ae->getOwner()->getLastName() ; 
	 // $this->owner= $ae->getOwner()->getId();
	  $this->picture = $ae->getPicture(); 
	  $this->Entity = $ae;
	}
	
	function getEntity() {	   
	   $this->Entity->setTitle($this->title);
       $this->Entity->setDescription($this->description);
	   # $this->Entity->setOwner($this->owner);
	   $this->Entity->setPicture($this->picture);	   
	   return $this->Entity;
    }	   
	
	
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id']))     ? $data['id']     : null;
		//$this->owner_id = (isset ($data['owner_id']))   ? $data['owner_id']   : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->description  = (isset($data['description']))  ? $data['description']  : null;
		#$this->owner  = (isset($data['owner']))  ? $data['owner']  : null;
		$this->picture  = (isset($data['picture']))  ? $data['picture']  : null;
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
                'name'     => 'title',
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
                'name'     => 'description',
                'required' => false,
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
                            'max'      => 1000,
                        ),
                    ),
                ),
            ));
			
			$inputFilter->add(array(
                'name'     => 'owner',
                'required' => false,
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

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
