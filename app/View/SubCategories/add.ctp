<?php echo $this->Form->create('SubCategory', array('class'=>'form-horizontal','enctype'=>'multipart/form-data', 'id'=>'update_user',
				'inputDefaults' => array(
					'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
					'div' => array('class' => 'control-group'),
					'label' => array('class' => 'control-label'),
					'between' => '<div class="controls">',
					'after' => '</div>',
					'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
				))); ?>
	<?php echo $this->element('save_changes'); ?>
   <div class='row'>
	  <div class='offset1'>
		 <div class='framed2'>
			<div class='framed2-header'>
			   <h2>Add SubCategory</h2>
			</div>
			<div class='row' style='margin-bottom:20px'>
			   <div class='span5'>
				 <div class=" control-group">
					<label class="control-label">Main Category</label>
					<div class="controls">
						 <?php
							 echo $this->Form->input('category_id',array(
														'type'=>'select', 
														'label' => false,
														'div' => false,
														'between' => false,
														'after' => false, 
														'style' => 'width: 150px',
														'options' => $categories													
														)
													);
						 ?>

					</div>
				 </div>
				<?php
				
					echo $this->Form->input('name',array('size'=>30, 'maxlength'=>30, 'class'=>'required',
						'label' => array('text' => 'Name<span class="required-marker">*</span>', 'class' => 'control-label'),
					));
					
				  ?>
				</div>
			</div>
			 
			<div class='form-actions'>
			   <button class="btn btn-success">
			   <i class="icon-white icon-ok"></i>
			   Save
			   </button>
			</div>
		 </div>
	  </div>
   </div>
</form>