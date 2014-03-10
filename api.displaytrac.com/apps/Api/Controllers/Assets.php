<?php 
namespace Api\Controllers;

class Assets extends \Dsc\Controller  
{	

	
     public function add($f3)
    {

        $body = $f3->get('BODY');

        $object = json_decode($body);

        

        $result = array();
        $model = new \Api\Models\Assets;
        try {
            if($object->key == 'AAB282D1FEC4B3395845869B3C133') {
            $asset = $model->create((array) $object);
            $result['response'] = true;
            $result['msg'] = 'Asset Added';
            $result['asset_id'] =  $asset->id;
            } else {
                $result['response'] = false;
                $result['msg'] = 'API Key Invalid';
            }
        
        } catch (\Exception $e) {

            $result['response'] = false;
            $result['msg'] = \Dsc\System::instance()->renderMessages();
            
        } finally {
            echo json_encode($result);  

        }
         die();
    }
	
 

}
?> 
