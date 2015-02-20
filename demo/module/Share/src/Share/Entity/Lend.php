<?php
namespace Share\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity @ORM\Table(name="Lend") */
class Lend {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="datetime") */
    protected $lend_begin;
	
	/** @ORM\Column(type="datetime") */
    protected $lend_end;
	
	
	
	/**
	* @ORM\ManyToOne(targetEntity="User")
	**/
	protected $lender;
	
	/**
	* @ORM\ManyToOne(targetEntity="Product")
	**/
	protected $product;
	

    function getLender() {
       return $this->lender;
    }

    function setLender($value) {
       $this->lender = $value;
    }
	
	function getProduct() {
       return $this->product;
    }

    function setProduct($value) {
       $this->product = $value;
    }
	
	function getLendBegin() {
       return $this->lend_begin;
    }
	function setLendBegin($value) {
       $this->lend_begin = $value;
    }

    function getLendEnd() {
       return $this->lend_end;
    }
	function setLendEnd($value) {
       $this->lend_end = $value;
    }
	
    function getId() {
    	return $this->id;
    }
}