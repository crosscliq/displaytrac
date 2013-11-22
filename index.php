<?php

$f3=require('lib/base.php');

$f3->set('AUTOLOAD','pusherserver/lib/');

$app_id = '59967';
$app_key = 'f3b8b0aeaf31c105168e';
$app_secret = '87a99b695fda2400d4fd';

putenv("PUSHER_APP_SECRET=$app_secret");
putenv("PUSHER_APP_KEY=$app_key");
putenv("PUSHER_APP_ID=$app_id ");

function nodePusher($id, $child) {
	
$data = array('id'=> $id, 'child' =>$child);
	//event to pusher
$app_id = '59967';
$app_key = 'f3b8b0aeaf31c105168e';
$app_secret = '87a99b695fda2400d4fd';

$pusher = new Pusher( $app_key, $app_secret, $app_id );
	$event = 	$pusher->trigger('nodes', 'addnode', $data );

}




$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

$f3->config('config.ini');

$f3->route('GET /',
    function($f3) {
       		
$db=new DB\Jig('db/',DB\Jig::FORMAT_JSON);
$dash=new DB\Jig\Mapper($db,'proofofplacement');
$dash->load(array('@dash=?','1'));

$f3->set('placements', array_reverse($dash->placements));


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


$image = array_keys($image);



$db=new DB\Jig('db/',DB\Jig::FORMAT_JSON);
$dash=new DB\Jig\Mapper($db,'proofofplacement');
$dash->load(array('@dash=?','1'));

$placements = $dash->placements;
$date = new DateTime();

$array = array(
		"href" => $image[0],
        "address" =>"122 S Pine Street Salt Lake City, UT 84037",
        "time" => $date->format('Y-m-d H:i:s'),
        "img" => $image[0]
	);

$placements[] = $array;
$dash->placements = $placements;
$dash->save();

$app_id = '59967';
$app_key = 'f3b8b0aeaf31c105168e';
$app_secret = '87a99b695fda2400d4fd';

$pusher = new Pusher( $app_key, $app_secret, $app_id );
		$pusher->trigger('images', $array, 'posted image named'. $image[0] );





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



// MOBILE ROUTES BELOW HERE

$f3->route('GET /m',
	function($f3) {

		$f3->set('SESSION.id', session_id());
		echo $f3->get('SESSION.id');
		$view=new View;

		nodePusher($f3->get('SESSION.id'), '0');
        
        echo $view->render('m/index.html');

	}
);


$f3->route('POST /m/index2',
	function($f3) {

		nodePusher($f3->get('SESSION.id'), 'index2');
//get the file that we uploaded
			$file = $_FILES['image'];


$overwrite = false; // set to true, to overwrite an existing file; Default: false
$slug = true; // rename file to filesystem-friendly version
$web = Web::instance();
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


$image = array_keys($image); //this is dumb


//save to database
$db=new DB\Jig('db/',DB\Jig::FORMAT_JSON);
$dash=new DB\Jig\Mapper($db,'proofofplacement');
$dash->load(array('@dash=?','1'));

$placements = $dash->placements;
$date = new DateTime();
$id = count($placements) + 1;
$array = array(
		"id" => $id,
		"href" => $image[0],
        "address" =>"122 S Pine Street Salt Lake City, UT 84037",
        "time" => $date->format('Y-m-d H:i:s'),
        "img" => $image[0]
	);

$placements[] = $array;
$dash->placements = $placements;
$dash->save();


//event to pusher
$app_id = '59967';
$app_key = 'f3b8b0aeaf31c105168e';
$app_secret = '87a99b695fda2400d4fd';

$pusher = new Pusher( $app_key, $app_secret, $app_id );
	$event = 	$pusher->trigger('images', 'addimage' , $array );


		$view=new View;
        echo $view->render('m/index2.html');

	}
);

$f3->route('GET /pusher',
	function($f3) {

	//event to pusher
$app_id = '59967';
$app_key = 'f3b8b0aeaf31c105168e';
$app_secret = '87a99b695fda2400d4fd';

$pusher = new Pusher( $app_key, $app_secret, $app_id );
	$event = 	$pusher->trigger('images', 'addImage', 'posted image named' );

	}
);


$f3->route('GET /m/index2',
	function($f3) {

		$view=new View;

        
        echo $view->render('m/index2.html');

	}
);


$f3->route('GET /m/map',
	function($f3) {

		$view=new View;
		nodePusher($f3->get('SESSION.id'), 'map');
        
        echo $view->render('m/map.html');

	}
);


$f3->route('GET /m/global',
	function($f3) {

		$view=new View;
		nodePusher($f3->get('SESSION.id'), 'global');
        
        echo $view->render('m/globalTrac.html');

	}
);


$f3->run();
