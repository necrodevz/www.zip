<?php echo $this->element('navbar'); ?>
   <head>
	<style>	
			 #map_canvas {
        width: 606px;
        height: 200px;
      }

     
    </style>

    </head>
	

<?php echo $this->Form->create('Product', array('class'=>'form-horizontal', 'id'=>'update_trip',
				'inputDefaults' => array(
					'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
					'div' => array('class' => 'control-group'),
					'label' => array('class' => 'control-label'),
					'between' => '<div class="controls">',
					'after' => '</div>',
					'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
				))); ?>

 <div class='add'>
	<div class='offset1'>
	   <div class='framed2'>
		  <div class='framed2-header'>
			 <p>
				Create An Artiste's Profile.
			 </p>
		  </div>
		  <div class="row" style="margin-top:10px;">
			  <?php 
			  
				echo $this->Form->input('name',array('size'=>40, 'maxlength'=>40,
					'label' => array('text' => 'Product Name', 'class' => 'control-label'),
				)); 
				
				echo $this->Form->input('description', array('id' => 'trip_description', 'type'=>'textarea', 'cols'=>40, 'rows'=>6,'maxlength'=>1000,
					'label' => array('class' => 'control-label'),
				)); 
				
				echo $this->Form->input('fav_song', array('id' => 'trip_description', 'text'=>'Favourite Song', 'type'=>'textarea', 'cols'=>40, 'rows'=>6,'maxlength'=>1000,
					'label' => array('class' => 'control-label'),
				)); 

				echo $this->Form->input('role_model', array('id' => 'trip_description', 'type'=>'textarea', 'cols'=>40, 'rows'=>6,'maxlength'=>1000,
					'label' => array('class' => 'control-label'),
				)); 
				
			  ?>
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
														'options' => $categories,
														'id' => 'category_id'
														)
													);
						 ?>

					</div>
				 </div>
				<?php 
				  
					echo $this->Form->input('address',array('size'=>30, 'maxlength'=>30,
						'label' => array('text' => 'Address, City', 'class' => 'control-label'),
						'class' => 'required span6',
					)); 
				?>
				 
						
						<?php 
			  
				echo $this->Form->input('youtube',array('size'=>40, 'maxlength'=>40,
					'label' => array('text' => 'Youtube', 'class' => 'control-label'),
				)); 
						?>

						<?php 
			  
				echo $this->Form->input('facebook',array('size'=>40, 'maxlength'=>40,
					'label' => array('text' => 'Facebook', 'class' => 'control-label'),
				)); 
						?>
						
						<?php 
			  
				echo $this->Form->input('twitter',array('size'=>40, 'maxlength'=>40,
					'label' => array('text' => 'Twitter', 'class' => 'control-label'),
				)); 
						?>						
			</div>
			 <div class='form-actions'>
				<button class="btn btn-info">Save</button>
			 </div>
		  </div>
	   </div>
	</div>
	<hr class='no-show'>
	</div>
</form>

<?php echo $this->element('save_changes'); ?>


