<?php
return array(
  'doctrine' => array(
    'connection' => array(
      'orm_default' => array(
        'driverClass' =>'Doctrine\DBAL\Driver\OCI8\Driver',
        'params' => array(
          'host'     => 'localhost',
          'port'     => '1521',
          'user'     => 'wifi',
          'password' => 'wifi',
          'dbname'   => 'wifi',
)))));
