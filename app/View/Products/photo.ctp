<?php

	echo $this->Html->script(
		'fileupload',
		array('inline' => true)
	);
	
	echo $this->Html->scriptBlock("
$(function() {
  var setupPhotos = function() {
    $('#images').sortable({
      items: 'li:not(.ui-state-disabled)',
      update: function(event, ui) {
        var imageId = ui.item.data('image-id');
        var position = $('#images li').index(ui.item);
        var url = $('#images').data('order-image-url');

        $.ajax({
          type: 'POST',
          data: {
            'image_id': imageId,
            'position': position
          },
          url: url
        });
      }
    });
    $('#images').disableSelection();

    $('#images li').hover(
      function() { $(this).find('.hover-state').show(); },
      function() { $(this).find('.hover-state').hide(); }
    );
  };
  setupPhotos();

  $('#image-cover-select').change(function() {
    var coverElement = $(this);
    var url = coverElement.data('url');
    var style = coverElement.val();
    $.ajax({
      type: 'POST',
      data: {
        'style': style
      },
      url: url
    });
  });

  $('#image-file-upload').fileupload({
    dataType: 'html',
    maxFileSize: 50000,
    sequentialUploads: true,
    add: function(e, data) {
      Vaya.Forms.clearErrors();
      data.submit();
    },
    start: function(e) {
      // Do not change the .fileinput-button in any way or you will break uploads after the first file
      $('#progress').show();
    },
    stop: function(e) {
      $('#progress').hide();
    },
    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      $('#progress .bar').css(
        'width', progress + '%'
      );
    },
    fail: function(e, data) {
      var xhr = data.jqXHR || {};
      if (xhr.status == 400) {
        alert(xhr.responseText);
      } else {
        alert('There was a problem adding images. Please try again.');
      }
    },
    done: function(e, data) {
      var imageCount = $('#images li').length;
      // If this was the first image upload, lets reload the page since it might be ready to publish
      if (imageCount == 0) {
        location.reload();
      } else {
        $('#images').append(data.result);
        setupPhotos();
      }
    }
  });
});"
,
		array('inline' => true)
	);

?>



<?php echo $this->element('navbar'); ?>

 <div class='row'>
	<div class='offset1'>
	   <div class='framed2'>
		  <div class='framed2-header'>
			 <div class='row'>
				<div class='span7'>
				   <h2>Photos</h2>
				   <p>
					  Add up to six high quality images
				   </p>
				</div>
				<div class='pull-right'>
				   <form accept-charset="UTF-8" action="/products/image/<?php echo $product['Product']['url']?>" class="edit_trip" enctype="multipart/form-data" id="upload_images" method="post">
					  <div>
						 <span class='btn btn-info btn-small fileinput-button' id='add-btn' <i class="icon-white icon-plus"></i>
						 <i class='icon-plus icon-white'></i>
						 <span>Add Photos</span>
						 <input data-url="/images/upload/<?php echo $product['Product']['url']?>" id="image-file-upload" multiple="multiple" name="data[Image][image]" type="file" />
						 </span>
					  </div>
				   </form>
				   <div style='clear:both;'>
					  <div class='progress progress-striped active' id='progress' style='min-width: 130px; margin-bottom: 0px; display: none'>
						 <div class='bar' style='width: 30%'></div>
					  </div>
				   </div>
				</div>
			 </div>
		  </div>
		  <div class='row'>
			 <div class='span9'>
				<ul class='thumbnails' data-order-image-url='/images/order_image/<?php echo $product['Product']['url']; ?>' id='images' style='min-height:100px; margin-left:60px;'>
					<?php 
						$i = 0;
						foreach($images as $id => $image)
						{
						?>
							
							<li data-image-id="<?php echo $id; ?>" class="<?php if($i == 0) echo 'span8 ui-state-disabled'; else echo 'span4 ui-state-default'; ?>">
								<div class="thumbnail">
									<img style="min-width:290px; <?php if($i == 0) echo 'min-height:163px;'; else echo 'max-height:163px;'; ?>" src="/files/products/<?php echo $image; ?>" alt="Image">
									<div class="hover-state" style="display: none;">
										<?php 
											if($i != 0)
											{
										?>
											<div class='hover-top'>
												<span class='move'>
													<i class='icon-move'></i>
												</span>
											</div>
										<?php
										}
										?>
										<div class="hover-bottom">
											<a href="/files/products/<?php echo $image; ?>">View</a>
											<?php 
											if($i != 0)
											{
											?>
												<a href="/images/order_image/<?php echo $product['Product']['url']; ?>?image_id=<?php echo $id; ?>&amp;position=0" data-confirm="Make this the cover image?" data-method="post" rel="nofollow">Cover</a>
											<?php
											}
											?>
											<a rel="nofollow" data-method="delete" data-confirm="Are you sure you want to delete this image?" href="/images/delete/<?php echo $product['Product']['url']; ?>?image_id=<?php echo $id; ?>">Delete</a>
										</div>
									</div>
								</div>
							</li>
							
						<?php
						$i+=1;
						}
					
					?>
				</ul>
			 </div>
		  </div>
	   </div>
	</div>
 </div>
 <hr class='no-show'>
<?php echo $this->Form->create('Product', array('class'=>'form-inline', 'id'=>'update_trip',
				'inputDefaults' => array(
					'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
					'div' => array('class' => 'control-group'),
					'label' => array('class' => 'control-label'),
					'between' => '<div class="controls">',
					'after' => '</div>',
					'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
				))); ?>
 </form>
 <hr class='no-show'>