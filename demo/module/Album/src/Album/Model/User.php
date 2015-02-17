<?php
namespace Album\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class User implements InputFilterAwareInterface
{
    public $id;
    public $fullname;
    public $gender_id;
    protected $Entity;
	protected $inputFilter;

	function __construct($us) {
	  if (empty($us)) {
	     return;
	  }	
	  $this->id = $us->getId();
	  $this->fullname = $us->getFullname();
	  $this->Entity = $us;
	}
	
	function getEntity() {	   
	   $this->Entity->setFullname($this->fullname);
	   return $this->Entity;
    }	   
	
	
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id']))     ? $data['id']     : null;
        $this->fullname = (isset($data['fullname'])) ? $data['fullname'] : null;

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
                'name'     => 'fullname',
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

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
