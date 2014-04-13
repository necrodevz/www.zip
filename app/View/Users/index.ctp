<div class="filter">
   <div class="header-prof">
      <h3>My Profile</h3>
   </div>
</div>

<?php echo $this->Form->create('User', array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data', 'id'=>'update_user',
				'inputDefaults' => array(
					'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
					'div' => array('class' => 'control-group'),
					'label' => array('class' => 'control-label'),
					'between' => '<div class="controls">',
					'after' => '</div>',
					'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
				))); ?>
	<?php echo $this->element('save_changes'); ?>
   <div class='event-span10 center' style="margin-top:142px">
	  <div class='offset1'>
		 <div class=''>
			<div class='row' style='margin-bottom:20px'>
			   <div class='span5'>
				  <?php 
				  
					echo $this->Form->input('first_name',array('size'=>30, 'maxlength'=>30, 'class'=>'required', 'placeholder'=>'First name',
						'label' => false,
					)); 
					
					echo $this->Form->input('last_name',array('size'=>30, 'maxlength'=>30, 'class'=>'required', 'placeholder'=>'Last name',
						'label' => false,
					)); 
					
					// echo $this->Form->input('Profile.company_name',array('size'=>30, 'maxlength'=>30, 'class'=>'required',
						// 'label' => array('text' => 'Company Name', 'class' => 'control-label'),
					// )); 
					
					// echo $this->Form->input('email',array('size'=>30, 'maxlength'=>30, 'class'=>'required email',
						// 'label' => array('class' => 'control-label'),
					// ));
				?>
				  <div class=" control-group">
					 <div class="controls">
						<?php 
						  
							echo $this->Form->input('Profile.phone',array(
								'size'=>30, 
								'maxlength'=>30,
								'label' => false,
								'div' => false,
								'between' => false,
								'after' => false,
								'placeholder'=>'Phone number',
								'class' => 'required',
							)); 
						?>
					 </div>
				  </div>
				  
				  				
				 <?PHP echo $this->Form->input('Profile.zone_id',array(
											'type'=>'select', 
											'label' => false,
											'class'=>'span4',
											'options' => $zones													
											)
										);
				
			  ?>
			   </div>
			   
			   <div class="profile-img">
			     <div class="add-img">
				 <a href="#"><i class="icon-plus icon-white"></i></a>
				 </div>
			   </div>
			   
			</div>
			

			

			  
				<?PHP // echo $this->Form->input('Profile.about_me',
					// array(
					// 'size'=>40, 
					// 'maxlength'=>1000, 
					// 'class'=>'span6', 
					// 'type'=>'textarea',
					// 'placeholder'=>'(Optional)',
					// 'label' => array('class' => 'control-label'),
					// )
				// ); 
				
				// echo $this->Form->input('Profile.languages',
					// array(
					// 'size'=>30, 
					// 'maxlength'=>30, 
					// 'class'=>'span6',
					// 'placeholder'=>'(Optional)',
					// 'label' => array('class' => 'control-label'),
					// )
				// ); ?>
				

			  
			<!--<div class=" control-group">
			   <label class="control-label">Email Settings</label>
			   <div class="controls"><label class='checkbox'>
				  <input id="user_send_draft_reminders" name="user[send_draft_reminders]" type="hidden" value="0" />
				  <input checked="checked" id="user_send_draft_reminders" name="user[send_draft_reminders]" type="checkbox" value="1" />
				  Send reminders about drafted experiences.
				  </label>
			   </div>
			</div>-->
			<div class='form-actions'>
			   <button class="btn btn-success btn-large">
			   <i class="icon-white icon-ok"></i>
			   Save
			   </button>
			</div>
		 </div>
	  </div>
   </div>
   <hr class='no-show'>
   <hr class='no-show'>
</form>