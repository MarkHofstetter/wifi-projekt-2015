<?php
namespace Share\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Share\Model\User;
use Share\Form\UserForm;


 class UserController extends AbstractActionController
 {
     public function indexAction()
     {
       $objectManager = $this
         ->getServiceLocator()
         ->get('Doctrine\ORM\EntityManager');

       $users = $objectManager->getRepository('Share\Entity\User')->findAll();
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
             $form->setInputFilter($users->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
             	 $objectManager = $this
                    ->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');

                 $data = $form->getData();
                 $ue = new \Share\Entity\User();
                 $ue->setFirstName($data['first_name']);
                 $ue->setLastName($data['last_name']);
				 $ue->setGender($data['gender']);

				$objectManager->persist($ue);
                $objectManager->flush();
                 // Redirect to list of albums
                return $this->redirect()->toRoute('User');
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
             return $this->redirect()->toRoute('User', array(
                 'action' => 'add'
             ));
         }


         try {
             #$album = $this->getAlbumTable()->getAlbum($id);
			 $ue = $objectManager->find('Share\Entity\User', $id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('User', array(
                 'action' => 'index'
             ));
         }

		 $users = new User($ue);
         $form  = new UserForm();
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
         $user = $objectManager->find('Share\Entity\User', $id);
		 # vereinfachte Suche - geht nur für Suche nach id
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