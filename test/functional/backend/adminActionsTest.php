<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
$username = 'admin';
$password = 'admin';

$browser = new sfTestFunctional(new sfBrowser());




$browser->
  info(sprintf('Signin user using username "%s" and password "%s"', $username, $password))->
  //post('/sfGuardAuth/signin', array('signin' => array('username' => $username, 'password' => $password)))->
 
  get('/admin/index')->

  with('request')->begin()->
    isParameter('module', 'admin')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('body', '!/This is a temporary page/')->
  end()
;
