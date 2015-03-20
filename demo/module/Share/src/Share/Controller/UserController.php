<?php
namespace Share\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Share\Model\User;
use Share\Form\UserForm;
use Share\Form\TrustForm;

 class UserController extends ShareController
 {
	 public function indexAction()
     {       
       $users = $this->objectManager->getRepository('Share\Entity\User')->findAll();
       return new ViewModel(array(
             'users'         => $users,
             'objectManager' => $this->objectManager,
			 'me'            => $this->user,
			 ));
	   
	 }
	 

     public function addAction()
     {
         $form = new UserForm();
        // $form->get('submit')->setValue('Add');
		 $form->get('submit')->setAttribute('value', 'anlegen');


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
                 $ae = new \Share\Entity\User();

                 $ae->setFirstName($data['first_name']);
                 $ae->setLastName($data['last_name']);
				 $ae->setGender($data['gender']);
				 $ae->setEmail($data['email']);
				 $ae->setUserName($data['username']);
				 $ae->setPassWord($data['password']);
				 $ae->setAdmin($data['admin']);

				$objectManager->persist($ae);
                $objectManager->flush();
                 // Redirect to list of users
                return $this->redirect()->toRoute('users');
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
			 $ae = $objectManager->find('Share\Entity\User', $id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('User', array(
                 'action' => 'index'
             ));
         }

		 $user = new User($ae);
         $form  = new UserForm();
		 #$album->title = $ae->getTitle();
         #$album->artist = $ae->getArtist();
		 $form->bind($user);
         $form->get('submit')->setAttribute('value', 'bearbeiten');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($user->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
				$data = $form->getData();
				$objectManager->persist($data->getEntity());
                $objectManager->flush();
                return $this->redirect()->toRoute('users');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
     }
	 
	 
	public function trustAction()
    {	    
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('User', array(
                 'action' => 'add'
             ));
         }
         try {
             #$album = $this->getAlbumTable()->getAlbum($id);
			 $trust_user = $this->objectManager->find('Share\Entity\User', $id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('User', array(
                 'action' => 'index'
             ));
         }
		  			 
         $form  = new TrustForm();
		 $form->get('trust_id')->setAttribute('value', $id);
         $form->get('submit')->setAttribute('value', 'wird mein Freund');

         $request = $this->getRequest();
         if ($request->isPost()) {
             # $form->setInputFilter($user->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) 
			 {            
                $data = $form->getData();
                $trust_user = $this->objectManager->find('Share\Entity\User', $data['trust_id']);
                $this->user->addTrustedUser($trust_user);
				$this->objectManager->persist($this->user);
                $this->objectManager->flush();
                return $this->redirect()->toRoute('users');
             }
			 else  return $this->redirect()->toRoute('users');
         }

         return array(
             'id' => $id,
			 'trust_id' => $id,
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
             return $this->redirect()->toRoute('users');
         }

         #$album = $objectManager->getRepository('Album\Entity\Album')
		 #          ->findOneBy(array('id' => $id));
         $user = $objectManager->find('Share\Entity\User', $id);
		 # vereinfachte Suche - geht nur für Suche nach id
		 #echo "Id $id". $album->getTitle() ;

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'Nein');

             if ($del == 'Ja') {
                 $id = (int) $request->getPost('id');
				 $objectManager->remove($user);     # löschen
				 $objectManager->flush();
             }

             // Redirect to list of users
             return $this->redirect()->toRoute('users');
         }

         return array(
             'id'    => $id,
             'user' => $user     # view "delete.phtml" wird aufgerufen (deleteAction --> delete-view wird aufgerufen)
         );
     }
	 
	  public function myfriendsAction()
    {
        
        $users_trusted = $this->user->getUsersTrusted();
       foreach ($users_trusted as $user) 
	   {
          $user->getFirstName();
		   
        }
		
        return new ViewModel(array(
          'users_trusted' => $users_trusted,
        ));
		
		
    
    }

 }