<?php

$f3=require('lib/base.php');

$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

$f3->config('config.ini');

$f3->route('GET /',
    function($f3) {
       
        $view=new View;
        echo $view->render('dashboard.htm');
    }
);

$f3->run();
