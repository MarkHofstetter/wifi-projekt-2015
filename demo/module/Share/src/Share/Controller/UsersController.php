<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Share\Model\Users;
use Share\Form\UsersForm;


 class UsersController extends AbstractActionController
 {
     public function indexAction()
     {
       $objectManager = $this
         ->getServiceLocator()
         ->get('Doctrine\ORM\EntityManager');

       $users = $objectManager->getRepository('Share\Entity\Users')->findAll();
       return new ViewModel(array(
             'user' => $users,
       ));
     }
	 
     public function addAction()
     {
         $form = new UsersForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $users = new User();
             $form->setInputFilter($users->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
             	 $objectManager = $this
                    ->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');

                 $data = $form->getData();
                 $ue = new \Share\Entity\Users();
                 $ue->setfirst_name($data['First Name']);
                 $ue->setlast_name($data['Last Name']);
				 $ue->setgender($data['Gender']);
                
				$objectManager->persist($ue);
                $objectManager->flush();
                 // Redirect to list of albums
                return $this->redirect()->toRoute('Users');
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
             return $this->redirect()->toRoute('Users', array(
                 'action' => 'add'
             ));
         }

        
         try {
             #$album = $this->getAlbumTable()->getAlbum($id);
			 $ue = $objectManager->find('Share\Entity\Users', $id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('Users', array(
                 'action' => 'index'
             ));
         }

		 $users = new User($ue);
         $form  = new UsersForm();
		 #$album->title = $ae->getTitle();
         #$album->artist = $ae->getArtist();
		 $form->bind($users);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($users->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {                
				$data = $form->getData();				
				$objectManager->persist($data->getEntity());
                $objectManager->flush();
                return $this->redirect()->toRoute('album');
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
             return $this->redirect()->toRoute('album');
         }

         #$album = $objectManager->getRepository('Album\Entity\Album')
		 #          ->findOneBy(array('id' => $id));
         $album = $objectManager->find('Album\Entity\Album', $id);  
		 # vereinfachte Suche - geht nur für Suche nach id				   
		 #echo "Id $id". $album->getTitle() ;

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
				 $objectManager->remove($album);     # löschen
				 $objectManager->flush();
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('album');
         }

         return array(
             'id'    => $id,
             'album' => $album     # view "delete.phtml" wird aufgerufen (deleteAction --> delete-view wird aufgerufen)
         );
     }
	 
	 public function fuffyAction()
     {
         return array('title'    => 'Fuffy');	   
     }

 }