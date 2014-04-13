<?php



class Dashboard extends AppModel

{

	/**

	 * Standard validation behaviour

	 */

	 

	var $actsAs = array ('Searchable', 'Containable');

	

	public $belongsTo = array('Category');

	 

	public $hasAndBelongsToMany = array(

		'SubCategory'=>array(

			'with' => 'ProductsSubCategory',

		)

	);

	

	public $hasMany = array('Image', 'MyTrip');

	

	function indexData() {

		$index = $this->data[$this->alias]['name'].'. '.$this->data[$this->alias]['description'].'. '.$this->data[$this->alias]['address'];

		$previous_cat = array();

		

		if(!empty($this->data['SubCategory']))

		{

			foreach($this->data['SubCategory'] as $sub)

			{

				$subcat = $this->SubCategory->find('first', array(

												'conditions' => array(

														'SubCategory.id' => $sub['ProductsSubCategory']['sub_category_id']

														),

												'recursive' => 0, //int

												)

										);

				

				if(!empty($subcat) && !isset($previous_cat[$subcat['SubCategory']['name']]))

				{	

					$index = $index.'. '.$subcat['SubCategory']['name'];

					$previous_cat[$subcat['SubCategory']['name']] = $subcat['SubCategory']['id'];

				}

			}

		}

		return $index;

	}



	

	var $validate = array(

		'name' => array(

			'length' => array(

				'rule'      => array('notEmpty'),

				'message'   => 'Please enter valid name',

				'required'  => true,

			),

		),

		'address' => array(

			'length' => array(

				'rule'      => array('notEmpty'),

				'message'   => 'Please enter valid address',

				'required'  => true,

			),

		),

		'description' => array(

			'text' => array(

				'rule'      => array('notEmpty'),

				'message'   => 'Please enter valid description',

				'required'  => false,

			),

		),

		'price_low' => array(

			'length' => array(

				'rule'      => array('notEmpty', 'decimal'),

				'message'   => 'Please enter valid price',

				'required'  => true,

			),

		),

		'price_high' => array(

			'length' => array(

				'rule'      => array('notEmpty', 'decimal'),

				'message'   => 'Please enter valid price',

				'required'  => true,

			),

		),

		'external_url' => array(

			'url'=>array(

				'rule' => array('parse_utf8_url'),

				'message' => 'Please enter valid url eg http://domain.com',

				'required' => false,

			),

		),

	);

	

	public function parse_utf8_url($data)

	{

		

		$url  = array_keys($data);

		

		static $keys = array('scheme'=>0,'user'=>0,'pass'=>0,'host'=>0,'port'=>0,'path'=>0,'query'=>0,'fragment'=>0);

		

		if(empty($data[$url[0]]))

			return true;

		

		if (is_string($data[$url[0]]) && preg_match(

				'~^((?P<scheme>[^:/?#]+):(//))?((\\3|//)?(?:(?P<user>[^:]+):(?P<pass>[^@]+)@)?(?P<host>[^/?:#]*))(:(?P<port>\\d+))?' .

				'(?P<path>[^?#]*)(\\?(?P<query>[^#]*))?(#(?P<fragment>.*))?~u', $data[$url[0]], $matches))

		{	

			foreach ($matches as $key => $value)

				if (!isset($keys[$key]) || empty($value))

					unset($matches[$key]);

			

			if(!isset($matches['scheme']))

				return false;

				

			return $matches;

		}

		return false;

	} 

	

}