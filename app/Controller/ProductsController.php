<?php

//App::uses('Sanitize', 'Utility');Sanitize::escape();

class ProductsController extends AppController
{
	var $components = array('Email', 'PaginatorArray');
	var $name = 'Products';
	
	function beforeFilter()
	{
		parent::beforeFilter();
			
		$this->Auth->allow('index', 'product', 'search');
		
		if($this->Auth->user('role') == 'admin')
			$this->SHOW_ALL = true;
	}
	
	public function index()
	{
		if($this->SHOW_ALL)
			$condition = array();
		else
			$condition = array('Product.show' => true);
		
		$this->paginate = array(
			'Product' => array(
				'conditions' => $condition,
				'limit' => 6,
				'order' => array(
					'Product.id' => 'asc',
				),
				'table' => 'products',
				'paramType' => 'querystring'
			),
		);

		$products = $this->paginate('Product');
		
		//debug($this->params['paging']);
		
		$this->set('products', $products);
		$this->layout = "mytrip";
	}
	
	public function add($url = null)
	{
		$product = array();
		$id = $this->Auth->user('id');
		
		$this->set('nav', 'product');
		
		$categories = $this->Product->Category->find('list');
		$this->set(compact('categories'));
		
		$sub_categories = $this->Product->SubCategory->find('list');
		$this->set(compact('sub_categories'));
		
		if($url){
		
			$product = $this->Product->find('first', array(
														'conditions' => array(
																			'Product.url' => $url, 
																			'Product.user_id' => $id
																			)
														)
											);
			
			if($product)
			{
				if (!empty($this->request->data))
				{
					$this->Product->id = $product['Product']['id'];
					//ensure the user_id and product_id are saved
					$this->request->data['Product']['user_id'] = $id;
					$this->request->data['Product']['id'] = $product['Product']['id'];
					
					//modify product url if name changes
					$rand = mt_rand(1000,9999); 
					
					$name = $this->request->data['Product']['name'];
					$url = $rand.'-'.str_replace(" ", "-", strtolower($name));
					$product['Product']['url'] = $this->request->data['Product']['url'] = $url;
					
					//debug($this->request->data);
					$this->Product->ProductsSubCategory->product_id = $this->Product->id;

					if ($this->Product->saveAll($this->request->data))
					{
						$this->_f('Product updated.');
					}
					else 
					{
						$this->_f('Unable to update product.', 'flash_error');
					}
				}
				
				//debug($this->Product->validationErrors);
			}
			else
			{
				$this->redirect(array('action' => 'add'));
			}

			if (!$this->request->data) {
				$this->request->data = $product;
			}
			
			//$this->request->data = $product;
			
			$this->set('product', $product);
			
		}
		else
			if ($this->request->is('post')) {
				if (!empty($this->request->data)) {
				
					//print_r($this->request->data);
					
					$rand = mt_rand(1000,9999); 
					
					$name = $this->request->data['Product']['name'];
					$url = $rand.'-'.str_replace(" ", "-", strtolower($name));
					$this->request->data['Product']['url'] = $url;
					$this->request->data['Product']['user_id'] = $id;
				
					$this->Product->create();
					if ($this->Product->saveAll($this->request->data))
					{
						$this->Session->setFlash(__('Product created Now Add Photos maximum 100kb', true));
						$this->redirect(array('action' => 'photo', $url));
					} 
					else
					{
						$this->Session->setFlash(__('Product not be created. Please, try again.', true));
					}
					//debug($this->Product->validationErrors);
				}
			}
			
			$this->layout="mytrip";
	}
	
	public function photo($url = null)
	{
		$id = $this->Auth->user('id');
		
		$this->set('nav', 'photo');
		
		if(!$url){
			throw new NotFoundException(__('Invalid product'));
		}

		$product = $this->Product->find('first', array('conditions' => array('Product.url' => $url, 'Product.user_id' => $id)));
		
		if(!$product)
		{
			throw new NotFoundException(__('Invalid product'));
		}
		
		$images = $this->Product->Image->find('list', 
				array(
					'conditions' => array('Image.product_id' => $product['Product']['id'], 'Image.user_id' => $id),
					'order' => array('Image.position' => 'asc'),//array('Image.position' => 'desc')
					'fields' => array('Image.id', 'Image.image'), //array of field names
				)
		);
		
		//debug($images);
		
		$this->set('images', $images);
		
		$this->set('product', $product);
		$this->layout = 'mytrip';
		
	}
	
	public function product($url = null)
	{
		$id = $this->Auth->user('id');
		
		if(!$url){
			throw new NotFoundException(__('Invalid product'));
		}
		
		$product_1 = $this->Product->find('first', array(
														'joins' => array(
															array(
																'table' => 'my_trips',
																'alias' => 'MyTrip',
																'type' => 'INNER',
																'conditions' => array(
																	'MyTrip.product_id = Product.id'
																),
															),
															
														),
														'conditions' => array(	
																				'Product.url' => $url,
																				'MyTrip.user_id' => $id
																			),
														'fields' => array('MyTrip.*', 'Product.*'),
														'contain' => array('Category.name', 'Image'),
													)
										);
										
		if(!empty($product_1))
			$product = $product_1;
		else
			$product = $this->Product->find('first', array(
														'conditions' => array(	
																				'Product.url' => $url,
																			),
														'contain' => array('Category.name', 'Image'),
														'recursive' => 0
													)
										);
		
		if(!$product)
		{
			throw new NotFoundException(__('Invalid product'));
		}
		
		$images = $this->Product->Image->find('list', 
				array(
					'conditions' => array('Image.product_id' => $product['Product']['id'], 'Image.user_id' => $id),
					'order' => array('Image.position' => 'asc'),//array('Image.position' => 'desc')
					'fields' => array('Image.id', 'Image.image'), //array of field names
				)
		);
		
		$randomProductIds = $this->Product->find('list', array(
															  'fields' => 'id',
															  'order' => 'RAND()',
															  'conditions' => array(
																					'Product.category_id' => $product['Product']['category_id'],
																					'Product.id !=' => $product['Product']['id']
																					),
															  'limit' => 4
														)
												);
		
		$similar_products = $this->Product->find('all', array(
														'conditions' => array('Product.id' => $randomProductIds),
														)
											);
		
		$this->set('product', $product);
		$this->set('images', $images);
		$this->set('similar_products', $similar_products);
		$this->layout = "product_details";
	}
	
	public function publish($url = null)
	{
		$id = $this->Auth->user('id');
		
		$this->set('nav', 'publish');
		
		if(!$url){
			throw new NotFoundException(__('Invalid product'));
		}
		
		$product = $this->Product->find('first', array('conditions' => array('Product.url' => $url), 'recursive' => 0 ));
		
		if(!$product)
		{
			throw new NotFoundException(__('Invalid product'));
		}
		
		if(!empty($this->request->data))
		{
			$this->Product->id = $product['Product']['id'];
			$product['Product']['show'] = $this->request->data['Product']['show'];
			$this->Product->save($product);
			$this->_f('Product visibility updated to ');
		}
		
		$this->set('product', $product);
	
	}
	
	public function delete($url = null)
	{
		$id = $this->Auth->user('id');
		
		if(!$url){
			throw new NotFoundException(__('Invalid product'));
		}
		
		$product = $this->Product->find('first', array('conditions' => array('Product.url' => $url), 'recursive' => 0));
		
		if(!$product)
		{
			throw new NotFoundException(__('Invalid product'));
		}
		
		if(isset($product['MyTrip']) && empty($product['MyTrip']))
		{
			$this->Product->delete($product['Product']['id']);
			$this->_f('Product deleted.');
			$this->redirect('/products');
		}
		else
		{
			$this->_f('Unable to delete product from database due to dependecies.', 'flash_error');
			$this->redirect('/product/'.$url);
		}
		
	}
	
	public function search()
	{

		$keyword = '';
		$page = 1;
		$cat = '';
			
		if(isset($this->params->query['q']))
			$keyword = $this->params->query['q'];
			
		if(isset($this->params->query['cat']))
			$cat = $this->params->query['cat'];
			
		if(isset($this->params->query['page']))
			$page = intval($this->params->query['page']);
			
		//debug($keyword);
		
		//$this->paginate = array(
			//'limit' => 1,
		//);
		
		$cat_id = '';
		
		if($this->SHOW_ALL)
			$conditions = array();
		else
			$conditions = array('Product.show' => true);
		
		if($cat != '')
			$conditions = array_merge(array('Product.category_id' => $cat), $conditions);
		
		$results = $this->Product->search($keyword, array('conditions'=> $conditions, 'recursive' => 2));
		
		$this->PaginatorArray->limit = 9;
		$this->PaginatorArray->order = array('Product.id' => 'asc');
		$products = $this->PaginatorArray->paginate('Product', $results, $page);
		
		//debug($results);
		$this->set('q', $keyword);
		$this->set('products', $products);
		$this->layout='product';
	}
	
	public function map()
	{
		$this->layout = 'map';
	}
	
		public function cart()
	{
		/*if($this->RequestHandler->isAjax())
		{
			$this->layout = '';
			
			$id = $this->Auth->user('id');
			
			$orders = $this->Product->Order->find('all', array('conditions'=>array('Order.user_id'=>$id)));
			
			$this->set('orders', $orders);
		}*/
	}
	
}
