<?php
return array(    
     'controllers' => array(
         'invokables' => array(
             'Share\Controller\Users' => 'Share\Controller\UsersController',
			  
         ),
     ),
     'router' => array(
         'routes' => array(
             'users' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/users[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Share\Controller\Users',
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
 
 
 