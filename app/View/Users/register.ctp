<div class="filter">
   <div class="header-sign">
      <h3>Sign Up</h3>
   </div>
</div>

<div class='container'>

<div class='' style='margin-bottom:50px; margin-top:83px;'>
   <div class='event-span6'>

		<?php echo $this->Form->create('User', array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data', 'id'=>'update_user',
						'inputDefaults' => array(
							'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
							'div' => array('class' => 'control-group'),
							'label' => array('class' => 'control-label'),
							'between' => '<div class="controls">',
							'after' => '</div>',
							'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
						))); ?>
						
						
		<?php  
			
			echo $this->Form->input('first_name',array('size'=>30, 'maxlength'=>30, 'class'=>'required',
				'label' => false, 'placeholder'=>'First name',
			)); 
			
			echo $this->Form->input('last_name',array('size'=>30, 'maxlength'=>30, 'class'=>'required',
				'label'=>false, 'placeholder'=>'Last name',
			)); 
			
			// echo $this->Form->input('Profile.company_name',array('size'=>30, 'maxlength'=>30, 'class'=>'required',
				// 'label' => array('text' => 'Company Name<span class="required-marker">*</span>', 'class' => 'control-label'),
			// )); 
			
			// echo $this->Form->input('Profile.phone',array('size'=>10, 'maxlength'=>10, 'class'=>'required',
				// 'label' => array('text' => 'Phone<span class="required-marker">*</span>', 'class' => 'control-label'),
			// ));
			
			echo $this->Form->input('email',array('size'=>30, 'maxlength'=>30, 'class'=>'required',
				'label' => false, 'placeholder'=>'Email',
			)); 
			
			echo $this->Form->input('password',array('size'=>30, 'maxlength'=>30, 'class'=>'required',
				'label' => false, 'placeholder'=>'Password',
			));

			echo $this->Form->input('password_confirm',array('size'=>30, 'maxlength'=>30, 'class'=>'required', 'type'=>'password',
				'label' => false, 'placeholder'=>'Repeat Password',
			)); 			
			
		?>
		
		 <div class='form-actions'>
			<button class="btn btn-info" style="width:250px;"><i class="icon-white icon-ok"></i> Register</button>
			<p class='fineprint' style='margin-top:8px'>
			   By clicking the register button above you confirm that you accept our
			   <a href="/terms" id="tos" target="_blank">Terms of Service.</a>
			</p>
		 </div>
		 <p class='auth-option'>
			Already have an account?
			<a href="/users/login" id="login-instead">Log in here.</a>
		 </p>
	  </form>
   </div>
</div>
</div>
