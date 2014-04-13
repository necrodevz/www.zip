<?php

class ImagesController extends AppController
{
	
	public function upload($product = null)
	{
	
		if(!$product){
			throw new NotFoundException(__('Invalid product'));
		}
		
		$id = $this->Auth->user('id');
		
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$found = $this->Image->Product->find('first', array('conditions' => array('Product.url' => $product, 'Product.user_id' => $id)));
			
			if (!empty($data) && !empty($found)){
			
				$count = $this->Image->find('count',  array('conditions' => array('Image.product_id' => $found['Product']['id'])));
				
				$data['Image']['user_id'] = $id;
				
				if(!empty($found))
				{
					$data['Image']['product_id'] = $found['Product']['id'];
					
					//$count += 1;
					
					$data['Image']['position'] = $count;
				}
				else
				{
					$response = array('sucess' => false);
					$this->sendJson($response);
				}
				
				$this->Image->create();
				
				if($this->Image->save($data)) 
				{
					$response = array('sucess' => true);
					$this->view = 'partial_image';
					$this->layout = false;
					
					$image = $this->Image->find('first', 
									array('conditions'=>array('Image.id' => $this->Image->id)
										)
									);
					
					$this->set('image', $image);
					$this->set('product', $found);
				}
				else
					{
						$response = array('sucess' => false);
						$this->sendJson($response);
					}
			}
			else
				{
					$response = array('sucess' => false);
					$this->sendJson($response);
				}
		}
	}
	
	public function order_image($product = null)
	{
		$id = $this->Auth->user('id');
		$response = array('success' => false);
		
		//debug($this->request->data);
		
		if(!$product){
			$this->sendJson($response);
		}
		
		$found = $this->Image->Product->find('first', array('conditions' => array('Product.url' => $product, 'Product.user_id' => $id)));
		
		  if(isset($this->params['url']['image_id'])) 
				$image_id = $this->params['url']['image_id'];
				
		  if(isset($this->params['url']['position'])) 
				$position = $this->params['url']['position'];
		
		if (!empty($found))
		{
			
			if(!empty($this->request->data))
			{
				$image_id = $this->request->data['image_id'];
				$position = $this->request->data['position'];
			}
			
			if(isset($image_id) && isset($position))
			{


				$image = $this->Image->find('first', array(
													'conditions' => array('Image.product_id' => $found['Product']['id'], 
																			'Image.user_id' => $id,
																			'Image.id' => $image_id,
																			)
													)
											);
											
				$image2 = $this->Image->find('first', array(
													'conditions' => array('Image.product_id' => $found['Product']['id'], 
																			'Image.user_id' => $id,
																			'Image.position' => $position,
																			)
													)
											);
											
				$images = $this->Image->find('list', 
						array(
							'conditions' => array('Image.product_id' => $found['Product']['id'], 'Image.user_id' => $id),
							'fields' => array('Image.id', 'Image.position'), //array of field names
						)
				);
				
				//debug($images);
											
				if(!empty($image) && !empty($image2))
				{					
					$this->Image->id = $image['Image']['id'];
					
					if($this->Image->saveField('position', $image2['Image']['position']))
					{
						if($position != 0)
						{
							foreach($images as $key => $pos )
							{
								if($key != $image['Image']['id'] && $pos != 0)
								{
									if($image['Image']['position'] < $position)
									{
										if($pos <= $position && $pos > $image['Image']['position'])
										{
											$this->Image->id = $key;
											$this->Image->saveField('position', $pos - 1);
										}
									}
									else
									{
										if($pos >= $position && $pos < $image['Image']['position'] )
										{
											$this->Image->id = $key;
											$this->Image->saveField('position', $pos + 1);
										}
									}
								}
							}
						}
						else
						{
							$this->Image->id = $image2['Image']['id'];
							$this->Image->saveField('position', $image['Image']['position']);
						}
						
						if ($this->request->is('post')) 
						{
							$response = array('success' => true);
							$this->sendJson($response);
						}
						else
						{
							$this->redirect(array('controller' => 'products', 'action' => 'photo', $product));
						}
					}
					
					//debug($this->Image->validationErrors);
				}
				
			}
		
		}
		
		
		if ($this->request->is('post')) 
		{
			$this->sendJson($response);
		}
		else
		{
			$this->redirect(array('controller' => 'products', 'action' => 'photo', $product));
		}
	
	}
	
	public function delete($product = null)
	{
		$id = $this->Auth->user('id');
		
		if(!$product){
			$this->redirect(array('controller' => 'products', 'action' => 'photo', $product));
		}
		
		$found = $this->Image->Product->find('first', array('conditions' => array('Product.url' => $product, 'Product.user_id' => $id)));
		
		if(isset($this->params['url']['image_id'])) 
				$image_id = $this->params['url']['image_id'];
				
		if($found)
		{
				$image = $this->Image->find('first', array(
													'conditions' => array('Image.product_id' => $found['Product']['id'], 
																			'Image.user_id' => $id,
																			'Image.id' => $image_id,
																			)
													)
											);
				
				if($image)
				{
					$this->Image->delete($image['Image']['id']);
					
					
					$images = $this->Image->find('list', 
							array(
								'conditions' => array('Image.product_id' => $found['Product']['id'], 'Image.user_id' => $id),
								'order' => array('Image.position' => 'asc'),
								'fields' => array('Image.id', 'Image.position'), //array of field names
							)
					);
					
					$i = 0;
					//and reduce the position of all the elements that follow image
					foreach($images as $key => $pos)
					{
						$this->Image->id = $key;
							
						if($i == 0)
							$this->Image->saveField('position', 0);
						else
							if($pos > $image['Image']['position'])
							{
								$this->Image->saveField('position', $pos - 1);
							}
						
						$i += 1;
					}
				}
		}
		
		$this->redirect(array('controller' => 'products', 'action' => 'photo', $product));
	}
	
	//download 
	//TODO: modify to enable non-authenticated and authenticated downloads
	public function download($Image = null)
	{
		$id = $this->Auth->user('id');
		$found = $this->Image->find('all', array('conditions' => array('Image.user_id' => $id)));
		$size = sizeof($found);
		$enable = false;
		
		for($i=0; $i < $size; $i++)
		{
			$test = str_replace("Images/uploads/","", $found[$i]['Image']['image']);
			$test2 = str_replace("Images/uploads/","", $found[$i]['Image']['imageSmall']);
			$test3 = str_replace("Images/uploads/","", $found[$i]['Image']['imageMedium']);
			
			if($Image == $test || $Image == $test2 || $Image == $test3)
			{
				$enable = true;
				break;
			}
		}
		
		if($enable == true)
		{
			$Image = WWW_ROOT.'Images/uploads/'.$Image;
			$this->set('Image', $Image);
			$this->layout = '';
			$this->render('/Elements' . DS . 'download');
		}
	}
}