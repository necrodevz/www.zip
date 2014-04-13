<div class="row">
   <div class="offset1">
		<div class="Add_Category">
			<p>
				<?php echo $this->Html->link('Add SubCategory', array('controller'=>'sub_categories', 'action'=>'add'), array('class'=>'btn btn-info')); ?>
			</p>
		</div>
   		<div class='framed2'>
			<table class="table table-striped">  
					<thead>  
					  <tr>				  
						<th>Category <?php echo $this->Paginator->sort('Name'); ?></th>  
						<th>Sub Category Name</th>  
						<th>Actions</th>			
					  </tr>  
					</thead> 
					<tbody>
						<?php foreach($cats as $cat):?>
							<tr>
								<td><?php echo $cat['Category']['name']; ?></td>
								<td><?php echo $cat['SubCategory']['name']; ?></td>
								<td>
									<?php echo $this->Html->link('Edit', array('controller'=>'sub_categories', 'action'=>'add', $cat['SubCategory']['id'] ), array('class'=>'action-link')); ?>
									<?php echo $this->Html->link('Delete', array('controller'=>'sub_categories', 'action'=>'delete', $cat['SubCategory']['id'] ), array('data-method'=>'delete', 'data-confirm'=>'Are you sure you want to delete this sub-category?', 'class'=>'action-link')); ?>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody> 
			</table>
			<?php echo $this->Paginator->numbers(); ?>
		</div>
	</div>
</div>