<?php
namespace Share\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
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
				 # $ae->setLendBegin($data['product_id']);
                 
				 $ae->setLendBegin(\DateTime::createFromFormat('Y-m-d', $data['lend_begin']));
                 $ae->setLendEnd(\DateTime::createFromFormat('Y-m-d', $data['lend_end']));
				 $product = $this->objectManager->find('Share\Entity\Product', $id);
				 $ae->setProduct($product);
				
				 # take user_id from the session and look up the user object by id				 
                 # $user = $objectManager->find('Share\Entity\User', $session->user_id);
				 # as we need the user all the time we read it in the parent class
        				 
				 # $ae->readowner_id($data['owner_id']); // read owner by id from doctrine
			

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