<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\User;
use Album\Form\UserForm;


 

class UserController extends AbstractActionController
 {
     public function indexAction()
     {
       $objectManager = $this
         ->getServiceLocator()
         ->get('Doctrine\ORM\EntityManager');

       $users = $objectManager->getRepository('Album\Entity\User')->findAll();
       return new ViewModel(array(
             'users' => $users,
       ));
     }
	 
	
	 
	 

     public function addAction()
     {
         $form = new UserForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $user = new User();
             $form->setInputFilter($user->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
             	   $objectManager = $this
                    ->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');

                 $data = $form->getData();
                 $us = new \Album\Entity\User();
                 $us->setfullName($data['fullname']);

                $objectManager->persist($us);
                $objectManager->flush();
                 // Redirect to list of albums
                 return $this->redirect()->toRoute('user');
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
             return $this->redirect()->toRoute('user', array(
                 'action' => 'add'
             ));
         }

         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             #$album = $this->getAlbumTable()->getAlbum($id);
			 $us = $objectManager->find('Album\Entity\User', $id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('user', array(
                 'action' => 'user'
             ));
         }

		 $user = new User($us);
         $form  = new UserForm();
		 #$album->title = $ae->getTitle();
         #$album->artist = $ae->getArtist();
		 $form->bind($user);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($user->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                #$this->getAlbumTable()->saveAlbum($album);
				$data = $form->getData();
				#echo $data->title;
                #$ae->setTitle($data->title);
                #$ae->setArtist($data->artist);
                #exit;
				$objectManager->persist($data->getEntity());
                $objectManager->flush();

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('user');
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
             return $this->redirect()->toRoute('user');
         }

         #$album = $objectManager->getRepository('Album\Entity\Album')
		 #          ->findOneBy(array('id' => $id));
         $user = $objectManager->find('Album\Entity\User', $id);  # vereinfachte Suche - geht nur für Suche nach id				   
		 #echo "Id $id". $album->getTitle() ;

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
				 $objectManager->remove($user);     # löschen
				 $objectManager->flush();
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('user');
         }

         return array(
             'id'    => $id,
             'user' => $user     # view "delete.phtml" wird aufgerufen (deleteAction --> delete-view wird aufgerufen)
         );
     }
	 
	 
	 
	 
 }