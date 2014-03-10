<?php 
$f3 = \Base::instance();
$global_app_name = $f3->get('APP_NAME');

switch ($global_app_name) 
{
    case "api":
        // register event listener
        //\Dsc\System::instance()->getDispatcher()->addListener(\Msft\Userlistener::instance());
        //\Dsc\System::instance()->getDispatcher()->addListener(\Msft\Pusherlistener::instance());
        //fixing a view bug where I shouldn't call my app Site
        
        //
       // $f3->config( $f3->get('PATH_ROOT').'apps/Msft/config.ini');
        //HEADERS ROUTES, these are so JS can call the headers TODO maybe move to this php logic
        $f3->route('POST /asset/add', '\Api\Controllers\Assets->add');    
        $f3->route('GET /', function () {
        	echo ' The only method Allowed is POST, and you have to post to valid routes valid data';
        });    
                
        break;
}
?>
