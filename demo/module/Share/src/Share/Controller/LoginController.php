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
             $form->setData($request->getPost());

             if ($form->isValid()) {
             	 $objectManager = $this
                    ->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');

               $data = $form->getData();
                //$objectManager->flush();

               $user = $objectManager->getRepository('Share\Entity\USer')
                 ->findOneBy(array('username' => $data['username'], 'password' => sha1($data['password'])));

               if (empty($user)) {
               	  return $this->redirect()->toRoute('login');
               }

				       $session = new \Zend\Session\Container('user');
                 $session->username_loggedin = $data['username'];
                 return $this->redirect()->toRoute('products');
             }
         }
         return array('form' => $form);

     }

     public function logoutAction()
     {
     	  $session = new \Zend\Session\Container('user');
     	  $session->getManager()->destroy();
     	  return $this->redirect()->toRoute('login');
     }
 }