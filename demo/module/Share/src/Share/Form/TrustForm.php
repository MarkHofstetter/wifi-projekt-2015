<?php

 namespace Share\Form;

 use Zend\Form\Form;

 class TrustForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('User');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));

         $this->add(array(
             'name' => 'trust_id',
             'type' => 'Hidden',
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