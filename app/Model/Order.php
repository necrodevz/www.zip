<?php

class Order extends AppModel
{
	/**
	 * Standard validation behaviour
	 */
	 
	var $actsAs = array ('Containable');
	
	public $belongsTo = array('User', 'Product');
	
	public function beforeSave($options = array()) {
	
		$orderOptions = array('open'=>0, 'closed'=>1);
	
		if (isset($this->data[$this->alias]['status']) && is_string($this->data[$this->alias]['status'])) {
			$this->data[$this->alias]['status'] = $orderOptions[$this->data[$this->alias]['status']];
		}
		return true;
	}
	
}