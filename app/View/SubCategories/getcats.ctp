 <?php
	for($i = 0; $i < 3; $i++)
	{
	 echo $this->Form->input('SubCategory.'.$i.'.ProductsSubCategory.sub_category_id',array(
								'type'=>'select', 
								'label' => false,
								'div' => false,
								'between' => false,
								'after' => false, 
								'style' => 'width: 150px',
								'options' => $sub_categories													
								)
							);
	}
 ?>