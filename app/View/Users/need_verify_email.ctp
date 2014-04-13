<div class='container'>
   <div class='row' style='margin-bottom:50px;'>
   
	  <div class='span6 offset3'>
	  <div class="trip-framed-header trip-framed-header-rounded framed2-header">
	  <h1 class="login_head">
	  Verify Email
	  </h1>
	  </div>
		 
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->Form->create('User', array(
				'class' => 'form-horizontal  framed',
				'inputDefaults' => array(
					'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
					'div' => array('class' => 'control-group'),
					'label' => array('class' => 'control-label'),
					'between' => '<div class="controls">',
					'after' => '</div>',
					'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
				)));?>

			<?php echo $this->Form->input('email', array(
				'label' => array('class' => 'control-label'),
			)); ?>
			
			<?php echo $this->Form->submit('Verify', array('type'=>'submit',
						'class' => 'btn-info btn-large',
						'div' => array('class' => 'form-actions'),
						'label' => false
				)); ?>
			
			<?php echo $this->Form->end();?>
	  </div>
   </div>
</div>
