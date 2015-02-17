<?php
namespace Album\Model;

// Add these import statements

//Model hat alle Filter drin für die Form, braucht man nicht unbedingt
//Model kann man gebreuchen um Daten zu validieren und normalisieren

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Album implements InputFilterAwareInterface
{
    public $id;
    public $artist;
    public $title;
    protected $Entity;
	protected $inputFilter;
	
	//übergeben dem edit Action ein doctrine Entity also die Daten aus der Datenbank
	function __construct($ae) {
	  if (empty($ae)) {
	     return;
	  }	
	  $this->id = $ae->getId();
	  $this->title = $ae->getTitle();
      $this->artist = $ae->getArtist(); 
	  $this->Entity = $ae;
	}
	
	function getEntity() {	   
	   $this->Entity->setTitle($this->title);
       $this->Entity->setArtist($this->artist);
	   return $this->Entity;
    }	   
	
	
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id']))     ? $data['id']     : null;
        $this->artist = (isset($data['artist'])) ? $data['artist'] : null;
        $this->title  = (isset($data['title']))  ? $data['title']  : null;
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
                'name'     => 'artist',
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

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
