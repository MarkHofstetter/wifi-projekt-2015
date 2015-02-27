<?php

 namespace Share\Form;

 use Zend\Form\Form;
 use Doctrine\ORM\EntityManager;

 class ProductForm extends Form
 {
     
	 public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('Product');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
		 
         $this->add(array(
             'name' => 'title',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Bezeichnung',
             ),
         ));
         $this->add(array(
             'name' => 'description',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Details',
             ),
         ));
		 
		$this->add(array(
             'name' => 'owner',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Owner',
             ),
         ));
		 
		 $this->add(array(
             'name' => 'picture',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Bildpfad',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
	 
	 
	 
	 
 }