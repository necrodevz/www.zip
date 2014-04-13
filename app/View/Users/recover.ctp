<div class="filter">
   <div class="header-recov">
      <h3>Recover Password</h3>
   </div>
</div>

<div class='container'>
   <div style='margin-bottom:50px; margin-top:83px'>
   
	  <div class='event-span6'>
		 
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->Form->create('User', array(
				'class' => 'form-horizontal',
				'inputDefaults' => array(
					'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
					'div' => array('class' => 'control-group'),
					'label' => array('class' => 'control-label'),
					'between' => '<div class="controls">',
					'after' => '</div>',
					'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
				)));?>

			<?php echo $this->Form->input('email', array(
				'label' => false, 'placeholder'=>'Your email',
			)); ?>
			
			<?php echo $this->Form->submit('Recover', array('type'=>'submit',
						'class' => 'btn-info btn-large',
						'div' => array('class' => 'form-actions'),
						'label' => false
				)); ?>
			
			<?php echo $this->Form->end();?>
	  </div>
   </div>
</div>
