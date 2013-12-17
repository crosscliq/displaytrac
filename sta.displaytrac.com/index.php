<?php

$f3=require('lib/base.php');

$f3->set('AUTOLOAD','pusherserver/lib/');


function nodePusher($id, $child, $data = array()) {
	
$data['id'] = $id; 
$data['child'] = $child;

	//event to pusher
$app_id = '59967';
$app_key = 'f3b8b0aeaf31c105168e';
$app_secret = '87a99b695fda2400d4fd';

$pusher = new Pusher( $app_key, $app_secret, $app_id );
	$event = 	$pusher->trigger('nodes', 'addnode', $data );

}




$f3->set('DEBUG',1);

$f3->config('config.ini');

$f3->route('GET /',
    function($f3) {
       		
$db=new DB\Jig('db/',DB\Jig::FORMAT_JSON);
$dash=new DB\Jig\Mapper($db,'proofofplacement');
$dash->load(array('@dash=?','1'));

$f3->set('placements', array_reverse($dash->placements));


 /*$db=new DB\SQL(
    'mysql:host=localhost;port=3306;dbname=locations',
    'root',
    'F0rgetting01'
);

       /* $places = new DB\SQL\Mapper($db,'places');
        $items = $places->find(array('enabled=?',1));

        $locations = array();

        foreach ($items as $location) {
            $locations[] = "{latLng: [".$location['latitude'].", ".$location['longitude']."], name: '".$location['name']."'}"; 
        }


       //echo  implode(', ', $locations);
        
        //die();*/

        $view=new View;

        $f3->set('nodetree', $view->render('nodetree.htm'));

        echo $view->render('dashboard.htm');
    }
);

$f3->set('UPLOADS','assets/'); // don't forget to set an Upload directory, and make it writable!


$f3->route('GET|POST /map/@lat/@lng/@name/@color',
    function($f3) {
            
        //event to pusher
$app_id = '59967';
$app_key = 'f3b8b0aeaf31c105168e';
$app_secret = '87a99b695fda2400d4fd';

$pusher = new Pusher( $app_key, $app_secret, $app_id );

$data = array();
$data['lat'] = $f3->get('PARAMS.lat');
$data['lng'] = $f3->get('PARAMS.lng');
$data['name'] = $f3->get('PARAMS.name');
$data['fill'] = $f3->get('PARAMS.color');

    $event =    $pusher->trigger('trafficmap', 'addTraffic', $data );
   

    }
);

$f3->route('GET|POST /map/update/@name/@color',
    function($f3) {
            
        //event to pusher
$app_id = '59967';
$app_key = 'f3b8b0aeaf31c105168e';
$app_secret = '87a99b695fda2400d4fd';

$pusher = new Pusher( $app_key, $app_secret, $app_id );

$data = array();
//$data['lat'] = $f3->get('PARAMS.lat');
//$data['lng'] = $f3->get('PARAMS.lng');
$data['name'] = $f3->get('PARAMS.name');
$data['fill'] = $f3->get('PARAMS.color');

 
    $event =    $pusher->trigger('trafficmap', 'changeColor', $data );

    }
);




// MOBILE ROUTES BELOW HERE


$f3->route('GET /m/global',
        function($f3) {

session_start();
    
    $f3->set('SESSION.id', session_id());

    $data = array();
    $data['type'] = 'node';
    $data['name'] = 'Global';
    $data['color'] = 'red';
    $data['link'] = '/m/global';

                $view=new View;
                nodePusher($f3->get('SESSION.id'), $f3->get('SESSION.id').'global', $data);

        echo $view->render('m/globalTrac.html');

        }
);



$f3->route('GET /m/global/@id',
        function($f3) {

session_start();
    
    $f3->set('SESSION.id', session_id());

    $data = array();
    $data['type'] = 'node';
    $data['name'] = $f3->get('PARAMS.id');
    $data['color'] = 'red';
    $data['link'] = '/m/global/'.$f3->get('PARAMS.id');

                $view=new View;
                nodePusher($f3->get('SESSION.id'), $f3->get('SESSION.id').'global', $data);

        echo $view->render('m/globalTrac.html');

        }
);


$f3->route('POST /asset/update',
  function($f3) {


    $data = array();
    $data['type'] = 'child';
    $data['parent'] = $f3->get('SESSION.id').'global';
    $data['name'] = $f3->get('POST.assetName');
    $data['color'] = 'green';
    $data['link'] = '/m/global/'.$f3->get('POST.id').'/'.$f3->get('POST.asset');
    nodePusher($f3->get('SESSION.id').'global', $f3->get('SESSION.id').$f3->get('POST.asset'), $data);
     
     $view=new View;
     echo $view->render('m/index2.html');



    }

);

$f3->route('POST /ajax/upload',
  function($f3) {
    $data = array();
    $data['type'] = 'child';
    $data['parent'] = $f3->get('SESSION.id').'global';
    $data['name'] = 'Uploaded Proof Image';
    $data['color'] = 'green';

    nodePusher($f3->get('SESSION.id').'global', $f3->get('SESSION.id').'imageuploaded', $data);
       //get the file that we uploaded
      $file = $_FILES['uploader'];


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
  $event =  $pusher->trigger('images', 'addimage' , $array );


    $view=new View;
        echo $view->render('m/index2.html');

  }
);



$f3->route('GET /thumbs/assets/@image/@width/@height',
    function($f3) {

$web = \Web::instance();
    $mime = 'image/jpeg';
   //header('Content-Type: '.$mime);   
$img = new Image($f3->get('PARAMS.image'), false, 'assets/');

$img->resize( 300, 200, true);
$img->render(); 
    }
);



$f3->route('GET|POST /m/index2',
	function($f3) {
    $data = array();
    $data['type'] = 'child';
    $data['name'] = 'Display Updated';
    $data['color'] = 'green';
    $data['link'] = '/m/index2';
		$view=new View;

        nodePusher($f3->get('SESSION.id').'imageuploaded', $f3->get('SESSION.id').'index2', $data);
        
        echo $view->render('m/index2.html');

	}
);


$f3->route('GET /m/map',
	function($f3) {
    $data['type'] = 'node';
    $data['name'] = 'Map';
    $data['color'] = 'red';
    $data['link'] = '/m/map';
		$view=new View;
		nodePusher($f3->get('SESSION.id').'global', $f3->get('SESSION.id').'map', $data);
        
        echo $view->render('m/map.html');

	}
);


$f3->route('GET /m/global/@id/@product',
  function($f3) {



    $product = $f3->get('PARAMS.product');
    $name = ucwords(str_replace('_', ' ', $product));
    $data = array();
    $data['type'] = 'child';
    $data['parent'] = $f3->get('SESSION.id').'global';
    $data['name'] = $name;
    $data['color'] = 'red';
    $data['link'] = '/m/global/'.$f3->get('PARAMS.id').'/'.$product;

    $f3->set('id',$f3->get('PARAMS.id'));
    $f3->set('product',$product);
    $f3->set('name',$name);
    $view=new View;
    nodePusher($f3->get('SESSION.id').'global', $f3->get('SESSION.id').$product, $data);
        
        echo $view->render('m/'.$product.'.html');

  }
);

$f3->route('GET /m/global/@id/@product/finish',
  function($f3) {



    $product = $f3->get('PARAMS.product');
    $name = ucwords(str_replace('_', ' ', $product));
    $data = array();
    $data['type'] = 'child';
    $data['parent'] = $f3->get('SESSION.id').'global';
    $data['name'] = $name;
    $data['color'] = 'red';
    $data['link'] = '/m/global/'.$f3->get('PARAMS.id').'/'.$product;

    $f3->set('id',$f3->get('PARAMS.id'));
    $f3->set('product',$product);
    $f3->set('name',$name);
    $view=new View;
    nodePusher($f3->get('SESSION.id').'global', $f3->get('SESSION.id').$product, $data);
     


      $data = array();
    $data['type'] = 'node';
    $data['name'] = $f3->get('PARAMS.id');
    $data['color'] = 'Green';
    $data['link'] = '/m/global';

                $view=new View;
                nodePusher($f3->get('SESSION.id'), $f3->get('SESSION.id').'global', $data);


   
        echo $view->render('m/'.$product.'.html');

  }
);

$f3->route('GET /m/global/@id/finish',
  function($f3) {



      $data = array();
    $data['type'] = 'node';
    $data['name'] = $f3->get('PARAMS.id');
    $data['color'] = 'Green';
    $data['link'] = '/m/global';

                $view=new View;
                nodePusher($f3->get('SESSION.id'), $f3->get('SESSION.id').'global', $data);

            $f3->mock('GET /map/update/S'.$f3->get("SESSION.id").'/green');
   
        echo $view->render('m/finished.html');

  }
);











$f3->run();
