<?php
namespace Share\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Share\Model\Product;
use Share\Form\ProductForm;

class ProductController extends AbstractActionController
{
public function indexAction()
{
$objectManager = $this
->getServiceLocator()
->get('Doctrine\ORM\EntityManager');
$products = $objectManager->getRepository('Share\Entity\Product')->findAll();
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
				 $ae->setOwner($data['owner']);
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
         if (!$id) {
             return $this->redirect()->toRoute('Product', array(
                 'action' => 'add'
             ));
         }


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


 }