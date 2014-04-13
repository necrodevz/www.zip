<?php

App::uses('Component', 'Controller');
App::import('Component', 'Auth');

class AppAuthComponent extends AuthComponent {
	
    public function identify(CakeRequest $user, CakeResponse $conditions) {
        $models = array('User', 'Admin');
		$passfield = "password";
		$userfield = "username";
		$db = array();
		
		if(!empty($this->authenticate) && array_key_exists('fields',$this->authenticate['Form'] ))
		{
			if(array_key_exists('password', $this->authenticate['Form']['fields']))
			$passfield = $this->authenticate['Form']['fields']['password'] ;
		
			if(array_key_exists('username', $this->authenticate['Form']['fields'])) 
				$userfield = $this->authenticate['Form']['fields']['username'];
		}
		
		
        foreach ($models as $model) {
		
			$this->request->data[$model] = $this->request->data["User"];
			$this->authenticate['Form']['userModel'] = $model;
			Controller::loadModel($model);
			
			$db = $this->$model->find('first', 
									array('conditions' => array($model.'.'.$userfield => $this->request->data[$model][$userfield], 
																$model.'.'.$passfield => AuthComponent::password($this->request->data[$model][$passfield]) 
																)
										) 
							);
			
			if(!empty($db) && is_array($db))
			{	
				$result = parent::identify($user, $conditions); // let cake do its thing
				
				//debug($result);
				// debug($user);
				//exit(1);
				
				if ($result) {
				
					//set user role
					$result['role'] = strtolower($model);
					return $result; // login success
				}
			}
        }
        return false; // login failure
    }
}

?>