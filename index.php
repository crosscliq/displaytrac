<?php

$f3=require('lib/base.php');

$f3->set('AUTOLOAD','pusherserver/lib/');

$app_id = '50411';
$app_key = 'f2b24963b454eac2cfd7';
$app_secret = '47bc64271eb245aadb71';

putenv("PUSHER_APP_SECRET=$app_secret");
putenv("PUSHER_APP_KEY=$app_key");
putenv("PUSHER_APP_ID=$app_id ");


$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

$f3->config('config.ini');

$f3->route('GET /',
    function($f3) {
       
        $view=new View;

        $f3->set('nodetree', $view->render('nodetree.htm'));

        echo $view->render('dashboard.htm');
    }
);

$f3->route('POST /upload/image',
    function($f3) {
       
        $view=new View;
        echo $view->render('dashboard.htm');
    }
);


$f3->route('POST /controller/input',
	function($f3) {
$app_id = '50411';
$app_key = 'f2b24963b454eac2cfd7';
$app_secret = '47bc64271eb245aadb71';

$pusher = new Pusher( $app_key, $app_secret, $app_id );
		$pusher->trigger('game', $f3->get('POST.key'), 'server knows you pressed '. $f3->get('POST.key'));
		
	}
);


$f3->run();
