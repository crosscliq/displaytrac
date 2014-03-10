<?php 
namespace Api\Models;

class Assets extends \Dsc\Mongo\Collection 
{
	/**
	 * Default Document Structure
	 * @var unknown
	 */
	public $_id;
	public $title;
    public $source;
	public $avatar;
	public $img;
	public $message;
	public $icon;
    public $published;

	
	protected $__collection_name = 'assets';

	
    protected function fetchConditions()
    {   
        parent::fetchConditions();
        
        $filter_keyword = $this->getState('filter.keyword');
        if ($filter_keyword && is_string($filter_keyword))
        {
            $key =  new \MongoRegex('/'. $filter_keyword .'/i');
    
            $where = array();
            $where[] = array('title'=>$key);
            $where[] = array('source'=>$key);
            $where[] = array('message'=>$key);
    
            $this->setCondition('$or', $where);
        }
    
        $filter_id = $this->getState('filter.id');
        if (strlen($filter_id))
        {
            $this->setCondition('_id', new \MongoId((string) $filter_id));
        }
        
        $filter_title = $this->getState('filter.title', null, 'string');
        if (strlen($filter_title))
        {
            $this->setCondition('title', $filter_title);
        }
        
        $filter_title_contains = $this->getState('filter.title-contains');
        if (strlen($filter_title_contains))
        {
            $key =  new \MongoRegex('/'. $filter_title_contains .'/i');
            $this->setCondition('title', $key);
        }
        
    
        return $this;
    }
    
    protected function beforeValidate()
    {
        
        return parent::beforeValidate();
    }

    public function validate()
    {
        // if you want, use $this->validateWith( $validator ) here
        
      /*  if (empty($this->title)) {
            $this->setError('title is required');
        }
        
        if (empty($this->message)) {
            $this->setError('Message is required');
        }*/
        
        return parent::validate();
    }
    
    public function beforeSave()
    {
                    
        return parent::beforeSave();
    }

}