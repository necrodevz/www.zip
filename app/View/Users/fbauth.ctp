<div>
	<?php echo $this->Facebook->registration(array(
		'fields' => 'name,gender,location,email',
		'width' => 600,
		'redirect-uri' => Router::url( $this->here, true )
	)); ?>
</div>