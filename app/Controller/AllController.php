<?PHP





class AllController extends AppController {
	  
	var $components = array('Email', 'PaginatorArray');
	var $name = 'Products';
	public $uses = array(
        'Category'
		);
	
	function beforeFilter()
	{
		parent::beforeFilter();
		
		$this->Auth->allow('index', 'search');
		if($this->Auth->user('role') == 'admin')
			$this->SHOW_ALL = true;
	}
	
	public function index()
	{
		//if($this->SHOW_ALL)
			//$condition = array();
		//else
			//$condition = array('Product.show' => true);
		
		$this->paginate = array(
			'Product' => array(
				'limit' => 28,
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
		$this->layout = "product";
		$this ->render('/All/index');
	}
	
	
}

