<?php
namespace Share\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity @ORM\Table(name="Products") */
class Product {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $title;
	
	/** @ORM\Column(type="string", nullable=true) */
   protected $description;
	
	/** @ORM\Column(type="string", nullable=true) */
    protected $picture;
	
	/**
	* @ORM\OneToMany(targetEntity="Lend", mappedBy="Product")
	**/
	protected $lend_products;
	
	/**
	* @ORM\ManyToOne(targetEntity="User")
	**/
	protected $owner;

    function getOwner() {
       return $this->owner;
    }

    function setOwner($value) {
       $this->owner = $value;
    }
	
	function getLendProducts() {
       return $this->lend_products;
    }

    function setLendProducts($value) {
       $this->lend_products = $value;
    }
	
	function getTitle() {
       return $this->title;
    }

    function setTitle($value) {
       $this->title = $value;
    }
	
	
	function getDescription() {
       return $this->description;
    }

    function setDescription($value) {
       $this->description = $value;
    }
	
	function getPicture() {
       return $this->picture;
    }

    function setPicture($value) {
       $this->picture = $value;
    }

    function getId() {
    	return $this->id;
    }
}