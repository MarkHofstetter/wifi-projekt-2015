<?php
namespace Share\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mail;
use Share\Model\Lend;
use Share\Form\LendForm;

class LendController extends ShareController
{
     public function addAction()
     {
         $form = new LendForm();
        // $form->get('submit')->setValue('Add');
		 $form->get('submit')->setAttribute('value', 'ausleihen');
         $id = (int) $this->params()->fromRoute('id', 0);
		 if (!$id) {
             return $this->redirect()->toRoute('products', array(
                 'action' => 'tolend'
               ));
         }
			

			 $product = $this->objectManager->find('Share\Entity\Product', $id);
			 echo	$product->getTitle($product);
			   ?>
			  <br/>
			 <?php
			 $product->getOwner()->getId();
			 
			 $user = $this->objectManager->find('Share\Entity\User', $product->getOwner()->getId());		 
			 echo	$user->getEmail($user);
			  ?>
			  <br/>
			 <?php			
			
			echo	$this->user->getEmail($user2);
			 
			 
			 
	
			$request = $this->getRequest();
			if ($request->isPost()) {
             $lend = new Lend();
			  
             $form->setInputFilter($lend->getInputFilter());		                  
             $form->setData($request->getPost());
			
             if ($form->isValid()) {
             	

			//$ae = $objectManager->find('Share\Entity\Product', $id);

                 $data = $form->getData();
                 $ae = new \Share\Entity\Lend();
				 $ae->setLender($this->user);
				 
                 
				 $ae->setLendBegin(\DateTime::createFromFormat('Y-m-d', $data['lend_begin']));
                 $ae->setLendEnd(\DateTime::createFromFormat('Y-m-d', $data['lend_end']));
				 $product = $this->objectManager->find('Share\Entity\Product', $id);
				$ae->getProduct($product);
				
				
				 # take user_id from the session and look up the user object by id				 
                 # $user = $objectManager->find('Share\Entity\User', $session->user_id);
				 # as we need the user all the time we read it in the parent class	 
				 # $ae->readowner_id($data['owner_id']); // read owner by id from doctrine
				
				
				$mail = new \Zend\Mail\Message;
				$mail->setBody($product->getTitle($product)." wurde verliehen");
					$mail->setFrom($user2->getEmail($user2), 'Ein Versender');
					$mail->addTo($user->getEmail($user), 'Ein Empfänger');
					$mail->setSubject('Share Verleihdaten');
					$mail->send();
				
				
				
				
				$this->objectManager->persist($ae);
                $this->objectManager->flush();			 
               
			   
			      
			   
                return $this->redirect()->toRoute('products');
             }
         }
         return array(
		   'id' => $id, 
		   'form' => $form
		   );

     }
}	