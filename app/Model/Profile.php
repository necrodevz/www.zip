<?php

class Profile extends AppModel
{
	/**
	 * Standard validation behaviour
	 */
	public $belongsTo =  array('User', 'Zone');
	
	var $validate = array(
	
		'user_id' => array(
		),
		'phone' => array(
			'phone'=> array(
				'rule' => array('phoneNumber'),
				'message' => 'Please enter a valid 10 digit phone number in the format(555-555-5555)',
				'required'  => true,
			)
		),				
		'zone_id' => array(
		),
	);
	
	public function phoneNumber()
	{
		//$phoneRE = "/^\s*(\d\d\d)[\- \.]?(\d\d\d\d)?\s*$/";
		$phoneRE_2 = "/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]‌​)\s*)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)([2-9]1[02-9]‌​|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})$/";
		
		if (!empty($this->data[$this->alias]['phone'])) {
		
			$phone = $this->data[$this->alias]['phone'];
		
			if (preg_match($phoneRE_2, $phone)) {
				return true;
			}
			
		}

		return false;
	}
	
}