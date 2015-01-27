<?php
return array(
  'doctrine' => array(
    'connection' => array(
      'orm_default' => array(
        'driverClass' =>'Doctrine\DBAL\Driver\PDOMySQL\Driver',
        'params' => array(
          'host'     => 'localhost',
          'port'     => '3306',
          'user'     => 'demo',
          'password' => 'demo',
          'dbname'   => 'demo',
)))));
