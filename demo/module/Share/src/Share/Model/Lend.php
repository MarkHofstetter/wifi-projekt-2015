<?php
namespace Share\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Lend implements InputFilterAwareInterface
{
    public $id;
    public $lender_id;
    public $product_id;
	public $lend_begin;
	public $lend_end;
	protected $Entity;
	protected $inputFilter;

	/*function __construct($ae) 
	{
	  if (empty($ae)) {
	     return;
	  }	
	  $this->id = $ae->getId();
	  $this->lender_id = $ae->getLender();
	  $this->product_id = $ae->getProduct();
      $this->lend_begin = $ae->getLendBegin(); 
	  $this->lend_end = $ae->getLendEnd();  
	  $this->Entity = $ae;
	}
	*/
	
	function getEntity() {	   
	   $this->Entity->setLender($this->lender);
       $this->Entity->setProduct($this->product);
	   $this->Entity->setLendBegin($this->LandBegin);
	   $this->Entity->setLendEnd($this->LendEnd);	   
	   return $this->Entity;
    }	   
	
	
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id']))     ? $data['id']     : null;
		$this->lender_id = (isset ($data['lender_id']))   ? $data['lender_id']   : null;
		$this->product_id = (isset ($data['product_id']))   ? $date['product_id']   : null;
        $this->land_begin = (isset($data['lend_begin'])) ? $data['lend_begin'] : null;
        $this->land_end = (isset($data['lend_end'])) ? $data['lend_end'] : null;
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
                'name'     => 'lend_begin',
                'required' => true,                
                'validators' => array(
                    array(
                        'name'    => 'Date',                        
                        
						'format' => 'd.m.Y',                 
                    ),
                ),
            ));
			
			$inputFilter->add(array(
                'name'     => 'lend_end',
                'required' => true,
                'filters'  => array(
                   
                ),

                'validators' => array(
                    array(
                        'name'    => 'Date',                        
                        'format' => 'd.m.Y',                        
                    ),
                ),
            ));


            
			
			

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}