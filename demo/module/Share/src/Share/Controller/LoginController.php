<?php
namespace Share\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Share\Model\Login;
use Share\Form\LoginForm;

 class LoginController extends AbstractActionController
 {
 
		public function indexAction()
     {
         $form = new LoginForm();
        // $form->get('submit')->setValue('Add');
		 $form->get('submit')->setAttribute('value', 'login');
		 

         $request = $this->getRequest();
         if ($request->isPost()) {
             $login = new login();
             $form->setInputFilter($login->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
             	 $objectManager = $this
                    ->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');

                 $data = $form->getData();
                 $ae = new \Share\Entity\Login();
		
				
				 $ae->setUserName($data['username']);
				 $ae->setPassWord($data['password']);
				 
				 

			   $query = $entityManager->createQuery('SELECT u.username, u.password FROM Share\Entity\User u WHERE u.username= $data[username] 
			   and u.password=$data[password]');
				$login = $query->getResult();
				
		
				 
				 
				 

				$objectManager->persist($ae);
                //$objectManager->flush();

				$session = new \Zend\Session\Container('user');
                $session->username_loggedin = $data['username'];
                return $this->redirect()->toRoute('users');
             }
         }
         return array('form' => $form);

     }
 }