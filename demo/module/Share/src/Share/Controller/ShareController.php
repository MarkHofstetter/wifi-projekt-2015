<?php
namespace Share\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


abstract class ShareController extends AbstractActionController {
	 public $objectManager;
   // public \Share\Entitiy\User $user;

	 public function __construct() {
       $this->getEventManager()->attach('dispatch', array($this, 'preDispatch'), 1000);
   }

   public function preDispatch() {
      $this->objectManager = $this->getServiceLocator()
              ->get('Doctrine\ORM\EntityManager');

       $session = new \Zend\Session\Container('user');
       if (!$session || !$session->username_loggedin) {
   	       return $this->redirect()->toRoute('login');
       }
       // read user Entitiy into $this->user
   }
}
