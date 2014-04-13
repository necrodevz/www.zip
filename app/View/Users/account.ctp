<?php echo $this->Form->create('User', array('class'=>'form-horizontal','enctype'=>'multipart/form-data', 'id'=>'update_user',
				'inputDefaults' => array(
					'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
					'div' => array('class' => 'control-group'),
					'label' => array('class' => 'control-label'),
					'between' => '<div class="controls">',
					'after' => '</div>',
					'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
				))); ?>
	<?php echo $this->element('save_changes'); ?>
   <div class='event-span6 center'>
	  <div class='offset1'>
		 <div class=''>
			<div class='framed2-header'>
			   <h2>Change Password</h2>
			</div>
			<div class='' style="width:400px;">
				<?php
				
					echo $this->Form->input('password_old',array('type'=> 'password', 'size'=>30, 'maxlength'=>30, 'class'=>'required',
						'label' => array('text' => 'Old Password<span class="required-marker">*</span>', 'class' => 'control-label'),
					));

					echo $this->Form->input('password',array('size'=>30, 'maxlength'=>30, 'class'=>'required', 'type'=>'password',
						'label' => array('text' => 'New Password<span class="required-marker">*</span>', 'class' => 'control-label'),
					)); 
					
					echo $this->Form->input('password_confirm',array('type'=> 'password', 'size'=>30, 'maxlength'=>30, 'class'=>'required',
						'label' => array('text' => 'Confirm Password<span class="required-marker">*</span>', 'class' => 'control-label'),
					));
					
				  ?>
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