<?php

 namespace Share\Form;

 use Zend\Form\Form;

 class UserForm extends Form
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
             'name' => 'first_name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Vorname',
             ),
         ));
         $this->add(array(
             'name' => 'last_name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Nachname',
             ),
         ));
	
		 
		 $this->add(array(
             'name' => 'gender',
             'type' => 'Radio',
             'options' => array(
                 'label' => 'Geschlecht m/w',
				 'value_options' => array(
                    'f' => 'Female',
                    'm' => 'Male',
                  ),
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