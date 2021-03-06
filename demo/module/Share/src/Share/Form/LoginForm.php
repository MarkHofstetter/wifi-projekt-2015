<?php
namespace Share\Form;
 use Zend\Form\Form;
 use Doctrine\ORM\EntityManager;

 class LoginForm extends Form
 {
     
    public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('Login');

        

         $this->add(array(
             'name' => 'username',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Username',
             ),
         ));
         $this->add(array(
             'name' => 'password',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Passwort',
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