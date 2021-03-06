<?php
namespace Share\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Share\Model\Product;
use Share\Form\ProductForm;

class ProductController extends ShareController
{

     public function indexAction()
     {
	    
        $products = $this->objectManager->getRepository('Share\Entity\Product')
		   ->findBy(array('owner' => $this->user ));
        return new ViewModel(array(
          'products' => $products,
        ));
     }


     public function addAction()
     {
         $form = new ProductForm();
        // $form->get('submit')->setValue('Add');
		 $form->get('submit')->setAttribute('value', 'anlegen');


         $request = $this->getRequest();
         if ($request->isPost()) {
             $product = new Product();
             $form->setInputFilter($product->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
             	 $objectManager = $this
                    ->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');



                 $data = $form->getData();
                 $ae = new \Share\Entity\Product();
                 $ae->setTitle($data['title']);
                 $ae->setDescription($data['description']);
				 
				 # take user_id from the session and look up the user object by id				 
                 # $user = $objectManager->find('Share\Entity\User', $session->user_id);
				 # as we need the user all the time we read it in the parent class
        				 
				 # $ae->readowner_id($data['owner_id']); // read owner by id from doctrine
				 $ae->setOwner($this->user);
				 $ae->setPicture($data['picture']);

				$objectManager->persist($ae);
                $objectManager->flush();
                 // Redirect to list of products
				$session = new \Zend\Session\Container('product');
                $session->lastproduct = $data['title'];
                return $this->redirect()->toRoute('products');
             }
         }
         return array('form' => $form);

     }

     public function editAction()
     {
	     $objectManager = $this
           ->getServiceLocator()
           ->get('Doctrine\ORM\EntityManager');

         $id = (int) $this->params()->fromRoute('id', 0);
         /*
		 if (!$owner_id) {
             return $this->redirect()->toRoute('Product', array(
                 'action' => 'add'
             ));
         }
         */

         try {
             #$album = $this->getAlbumTable()->getAlbum($id);
			 $ae = $objectManager->find('Share\Entity\Product', $id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('Product', array(
                 'action' => 'index'
             ));
         }

		 $product = new Product($ae);
         $form  = new ProductForm();
		 $form->bind($product);
         $form->get('submit')->setAttribute('value', 'bearbeiten');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($product->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
				$data = $form->getData();
				$objectManager->persist($data->getEntity());
			
                $objectManager->flush();
                return $this->redirect()->toRoute('products');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
     }

	 public function deleteAction()
     {
         $objectManager = $this
           ->getServiceLocator()
           ->get('Doctrine\ORM\EntityManager');

         $id = (int) $this->params()->fromRoute('id', 0);
		 # echo "Id $id";

         if (!$id) {
             return $this->redirect()->toRoute('products');
         }

         #$album = $objectManager->getRepository('Album\Entity\Album')
		 #          ->findOneBy(array('id' => $id));
         $product = $objectManager->find('Share\Entity\Product', $id);
		 # vereinfachte Suche - geht nur für Suche nach id
		 #echo "Id $id". $album->getTitle() ;

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'Nein');

             if ($del == 'Ja') {
                 $id = (int) $request->getPost('id');
				 $objectManager->remove($product);     # löschen
				 $objectManager->flush();
             }

             // Redirect to list of products
             return $this->redirect()->toRoute('products');
         }

         return array(
             'id'    => $id,
             'product' => $product     # view "delete.phtml" wird aufgerufen (deleteAction --> delete-view wird aufgerufen)
         );
     }

    public function availableAction() {
        
        $users_that_trust_me = $this->user->getUsersThatTrustMe();
       foreach ($users_that_trust_me as $user) {
           echo $user->getFirstName() .'<br>';
		   foreach ($user->getProductUsers() as $product) {
		      echo $product->getTitle().'<br>';
		   }
        }
		
        return new ViewModel(array(
          'users_that_trust_me' => $users_that_trust_me,
        ));
	
	}
	
	public function tolendAction() 
	{
       $users_that_trust_me = $this->user->getUsersThatTrustMe();       
       return new ViewModel(array(
          'users_that_trust_me' => $users_that_trust_me,
       ));
		
    }
	
	
	
	
}	