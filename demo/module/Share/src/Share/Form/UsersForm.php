<?php

 namespace Users\Form;

 use Zend\Form\Form;

 class UsersForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('Users');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'First Name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'First Name',
             ),
         ));
         $this->add(array(
             'name' => 'Last Name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Last Name',
             ),
         ));
		 $this->add(array(
             'name' => 'Gender',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Gender',
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