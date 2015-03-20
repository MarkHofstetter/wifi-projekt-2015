<?php
namespace Share\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


abstract class ShareController extends AbstractActionController {
	 public $objectManager;
     public $user;

	 public function __construct() {
       $this->getEventManager()->attach('dispatch', array($this, 'preDispatch'), 1000);
   }

   public function preDispatch() {
      $this->objectManager = $this->getServiceLocator()
              ->get('Doctrine\ORM\EntityManager');
      $dbh = $this->objectManager->getConnection();
      $sth = $dbh->prepare("ALTER SESSION SET NLS_DATE_FORMAT='YYYY-MM-DD HH24:MI:SS'");
	  $sth->execute();
       $session = new \Zend\Session\Container('user');
       if (!$session || !$session->username_loggedin) {
   	       return $this->redirect()->toRoute('login');
       }
          
       $this->user = $this->objectManager->find('Share\Entity\User', $session->user_id);		         
   }
}
