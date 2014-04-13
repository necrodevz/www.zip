<?php
class SubCategoriesController extends AppController
{
	var $components = array('Email');
	var $name = 'SubCategories';
	
	function beforeFilter()
	{
		parent::beforeFilter();
		//$this->Auth->allow('get');
		
	}
	
	public function index()
	{		
		$this->paginate = array(
			'SubCategory' => array(
				'limit' => 20,
				'order' => array(
					'Category.id' => 'asc',
				),
			),
		);

		$cats = $this->paginate('SubCategory');
		$this->set('cats', $cats);
	}
	
	public function getcats($id = null)
	{
		$this->layout = false;
		
		$sub_categories = $this->SubCategory->find('list', array('conditions' => array('SubCategory.category_id' => $id)));
		$this->set(compact('sub_categories'));
	}
	
	public function delete($id = null)
	{
		$ToursSubCategoryClass = ClassRegistry::init('ToursSubCategory');
		
		if($id != null)
		{
			
			$products = $ToursSubCategoryClass->find('first', array('conditions' => array('ToursSubCategory.sub_category_id' => $id)));
			
			if(empty($products))
			{
			
				if($this->SubCategory->delete($id))
				{
					$this->_f('SubCategory deleted.');
				}
				else
				{
					$this->_f('SubCategory cannot be deleted.', 'flash_error');
				}
			}
			else
			{
				$this->_f('SubCategory '.$products['SubCategory']['name'].' cannot be deleted at this time there are database dependecies.', 'flash_error');
			}
		}
		
		$this->redirect(array('action' => 'index'));
	}
	
	public function add($id = null)
	{
		$Category = ClassRegistry::init('Category');
		
		$categories = $Category->find('list');
		$this->set(compact('categories'));

		if ($id) {	
			$sub_category = $this->SubCategory->find('first', array('conditions' => array('SubCategory.id' => $id)));			
			
			if (!empty($this->request->data))
			{
				
				//debug($this->request->data);
				//$this->Tour->ToursCategory->product_id = $this->Tour->ToursSubCategory->product_id = $product['Tour']['id'];
				
				$this->SubCategory->id = $id;

				if ($this->SubCategory->save($this->request->data))
				{
					$this->_f('Category updated.');
				}
				else 
				{
					$this->_f('Unable to update Category.', 'flash_error');
				}
			}
			
			$this->request->data = $sub_category;
		}
		else
			if ($this->request->is('post')) {
				if (!empty($this->request->data)) {
				
					$this->SubCategory->create();
					if ($this->SubCategory->save($this->request->data))
					{
						$this->_f('Category created');
					} 
					else
					{
						$this->_f('Category could not be created. Please, try again.', 'flash_error');
					}
					//debug($this->SubCategory->validationErrors);
				}
			}
	}
	
}
