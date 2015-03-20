<?php

 namespace Share\Form;
 use Zend\Form\Form;
 use Doctrine\ORM\EntityManager;

 class LendForm extends Form
 {
     
	 public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('Lend');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
		 
		 $this->add(array(
             'name' => 'product_id',
             'type' => 'Hidden',
         ));
		 
		 
		 $this->add(array(
             'name' => 'lender_id',
             'type' => 'Hidden',
         ));
		 

         
		 $this->add(array(
            'type' => 'Zend\Form\Element\Date',
            'name' => 'lend_begin',
            'options' => array(
                'label' => 'von-datum'
            )
        ));
		 
		 $this->add(array(
            'type' => 'Zend\Form\Element\Date',
            'name' => 'lend_end',
            'options' => array(
                'label' => 'bis-datum'
            )
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