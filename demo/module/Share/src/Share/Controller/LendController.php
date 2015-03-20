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
				

         $request = $this->getRequest();
         if ($request->isPost()) {
             $lend = new Lend();
             $form->setInputFilter($lend->getInputFilter());
			 $request->getPost('id');
             $form->setData($request->getPost());
			
             if ($form->isValid()) {
             	 $objectManager = $this
                    ->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');

			//$ae = $objectManager->find('Share\Entity\Product', $id);

                 $data = $form->getData();
                 $ae = new \Share\Entity\Lend();
				 $ae->setLender($this->user);
				 $ae->setLendBegin($data['product_id']);
                 $ae->setLendBegin($data['lend_begin']);
                 $ae->setLendEnd($data['lend_end']);
				
				 # take user_id from the session and look up the user object by id				 
                 # $user = $objectManager->find('Share\Entity\User', $session->user_id);
				 # as we need the user all the time we read it in the parent class
        				 
				 # $ae->readowner_id($data['owner_id']); // read owner by id from doctrine
			

				$objectManager->persist($ae);
                $objectManager->flush();
				
               
                return $this->redirect()->toRoute('products');
             }
         }
         return array('form' => $form);

     }

    
	
}	