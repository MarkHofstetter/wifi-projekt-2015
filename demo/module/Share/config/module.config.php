<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Share\Controller\User' => 'Share\Controller\UserController',
			 'Share\Controller\Product' => 'Share\Controller\ProductController',
			 'Share\Controller\Login' => 'Share\Controller\LoginController',
			 'Share\Controller\Lend' => 'Share\Controller\LendController',
         ),
     ),
     'router' => array(
         'routes' => array(
             'users' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/share/users[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Share\Controller\User',
                         'action'     => 'index',
                     ),
                 ),
             ), 

             'products' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/share/products[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Share\Controller\Product',
                         'action'     => 'index',
                     ),
                 ),
             ),
			 
			 
			 
			 
			 'login' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/share/login[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Share\Controller\Login',
                         'action'     => 'index',
                     ),
                 ),
             ),
			 
			 
			 'lend' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/share/lend[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Share\Controller\Lend',
                         'action'     => 'index',
                     ),
                 ),
             ),
			 
			 
			 

         ),
     ),
	
	

	 
     'doctrine' => array(
         'driver' => array(
           'application_entities' => array(
             'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
             'cache' => 'array',
             'paths' => array(__DIR__ . '/../src/Share/Entity')
           ),

           'orm_default' => array(
             'drivers' => array(
               'Share\Entity' => 'application_entities'
             )
      ))),
     'view_manager' => array(
         'template_path_stack' => array(
             'share' => __DIR__ . '/../view',
         ),
     ),
 );


