<?php

$f3=require('lib/base.php');

$f3->set('AUTOLOAD','pusherserver/lib/');

$app_id = '59967';
$app_key = 'f3b8b0aeaf31c105168e';
$app_secret = '87a99b695fda2400d4fd';

putenv("PUSHER_APP_SECRET=$app_secret");
putenv("PUSHER_APP_KEY=$app_key");
putenv("PUSHER_APP_ID=$app_id ");


$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

$f3->config('config.ini');

$f3->route('GET /',
    function($f3) {
       		
$db=new DB\Jig('db/',DB\Jig::FORMAT_JSON);
$dash=new DB\Jig\Mapper($db,'proofofplacement');
$dash->load(array('@dash=?','1'));

$f3->set('placements', $dash->placements);


        $view=new View;

        $f3->set('nodetree', $view->render('nodetree.htm'));

        echo $view->render('dashboard.htm');
    }
);

$f3->route('GET /form',
    function($f3) {
       		

        $view=new View;

        
        echo $view->render('form.htm');
    }
);

$f3->set('UPLOADS','assets/'); // don't forget to set an Upload directory, and make it writable!

$f3->route('POST /upload/image',
    function($f3) {

$file = $_FILES['image'];


$overwrite = false; // set to true, to overwrite an existing file; Default: false
$slug = true; // rename file to filesystem-friendly version
$web = \Web::instance();
$image = $web->receive(function($file){
  
        /* looks like:
          array(5) {
              ["name"] =>     string(19) "csshat_quittung.png"
              ["type"] =>     string(9) "image/png"
              ["tmp_name"] => string(14) "/tmp/php2YS85Q"
              ["error"] =>    int(0)
              ["size"] =>     int(172245)
            }
        */
        // maybe you want to check the file size
       // if($file['size'] > (2 * 1024 * 1024)) // if bigger than 2 MB
        //    return false; // this file is not valid, return false will skip moving it

        // everything went fine, hurray!
        return true; // allows the file to be moved from php tmp dir to your defined upload dir
    },
    $overwrite,
    $slug
);



var_dump($image);
die();


    }

);



$f3->route('POST /controller/input',
	function($f3) {
$app_id = '59967';
$app_key = 'f3b8b0aeaf31c105168e';
$app_secret = '87a99b695fda2400d4fd';

$pusher = new Pusher( $app_key, $app_secret, $app_id );
		$pusher->trigger('game', $f3->get('POST.key'), 'server knows you pressed '. $f3->get('POST.key'));
		
	}
);


$f3->run();
