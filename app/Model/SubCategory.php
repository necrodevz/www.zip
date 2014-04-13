<?php

class SubCategory extends AppModel
{
	/**
	 * Standard validation behaviour
	 */
	public $hasAndBelongsToMany = array(
		'Product'=>array(
			'ClassName'=>'Product',
			'joinTable' => 'products_sub_categories',
			'foreignKey' => 'sub_category_id',
			'associationForeignKey'  => 'product_id'
		)
	);
	
	public $belongsTo = array('Category');
	
}