<?php
class MyTripsController extends AppController
{
	var $components = array('Email');
	var $name = 'MyTrips';
	
	function beforeFilter()
	{
		parent::beforeFilter();
		//$this->Auth->allow('get');
		
		if($this->Auth->user('role') == 'user') { 
			$this->Auth->allow('index', 'add', 'remove');
		}
		
	}
	
	public function index()
	{
		$this->set('title_for_layout', 'My Favourites');
		$id = $this->Auth->user('id');
		
		$categories = array();
		
		$List = $this->MyTrip->Product->Category->find('list', array(
																	'fields' => array(
																		'Category.id'
																	)
																)
														);
		
		foreach($List as $key=>$value)
		{
			$categories[] = $this->MyTrip->find('all', array(
													'contain' => array('Product','Product.Image','Product.Category','Product.SubCategory'),
													'conditions' => array(
														'Product.category_id' => $value,
														'MyTrip.user_id' => $id
													),
													'recursive' => 0
												)
										);
			
		}

		$my_trips = $categories;//$this->paginate('MyTrip');
		
		$this->set('my_trips', $my_trips);
		$this->layout = 'mytrip';
	}
	
	public function add($url = null)
	{
		$id = $this->Auth->user('id');

		if(!$url){
			throw new NotFoundException(__('Invalid product'));
		}
		
		$product = $this->MyTrip->Product->find('first', array('conditions' => array('Product.url' => $url), 'recursive'=> 0));
		
		if(!$product)
		{
			throw new NotFoundException(__('Invalid product'));
		}
		
		$my_trip['MyTrip'] = array(
			'product_id' => $product['Product']['id'],
			'user_id' => $id
		);
		
		$found_trip = $this->MyTrip->find('first', array('conditions' => array('MyTrip.product_id' => $product['Product']['id'], 'MyTrip.user_id' => $id ), 'recursive'=> 0));
		
		$url = '/product/'.$url;
		
		if(empty($found_trip))
		{
		
			if ($this->MyTrip->save($my_trip))
			{
			
				if(isset($this->request->query['r']))
					$url = $this->request->query['r'];
					
				$view = new View($this);
				$Html = $view->loadHelper('Html');
				
				$link = $Html->link('View In My Fan List', array('controller'=>'my_trips', 'action'=>'index'), array('style'=>'color:red;'));
				
				if($url != '/home')
					$this->_f('Artiste added to My Favourites '.$link.'.');
				else
					$this->_f('Artiste added to Favourites');
			}
			else 
			{
				$this->_f('Unable to add Artiste to Favourites.', 'flash_error');
			}
		
		}

		$this->redirect($url);
	}
	
	public function remove($url = null)
	{
		$id = $this->Auth->user('id');

		if(!$url){
			throw new NotFoundException(__('Invalid product'));
		}
		
		$product = $this->MyTrip->Product->find('first', array('conditions' => array('Product.url' => $url), 'recursive'=> 0));
		
		if(!$product)
		{
			throw new NotFoundException(__('Invalid product'));
		}
		
		$my_trip['MyTrip'] = array(
			'product_id' => $product['Product']['id'],
			'user_id' => $id
		);
		
		$found_trip = $this->MyTrip->find('first', array('conditions' => array('MyTrip.product_id' => $product['Product']['id'], 'MyTrip.user_id' => $id ), 'recursive'=> 0));
		
		if(!empty($found_trip))
		{
			if ($this->MyTrip->delete($found_trip['MyTrip']['id']))
			{	
				if(!isset($this->request->query['r']))
				{
					$this->_f('Artiste removed from Favourites');
					$url = '/product/'.$url;
				}
				else
				{
					$view = new View($this);
					$Html = $view->loadHelper('Html');
					
					$link = $Html->link('Undo', array('controller'=>'my_trips', 'action'=>'add', $url, '?' => array('r' => '/home')), array('style'=>'color:red;'));
					$this->_f('Artiste removed from Favourites '.$link.'.');
					
					$url = $this->request->query['r'];
				}
			}
			else 
			{
				$this->_f('Unable remove product from Favourites.', 'flash_error');
			}
		}
		
		$this->redirect($url);
	}
	
}
