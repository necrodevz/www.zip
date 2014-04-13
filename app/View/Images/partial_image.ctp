<li class='span4 ui-state-default' data-image-id='<?php echo $image['Image']['id']; ?>'>
	<div class='thumbnail'>
		<img alt="Image" src="/files/products/<?php echo $image['Image']['image']; ?>" style="min-width:290px; max-height:163px" />
		<div class='hover-state'>
			<div class='hover-top'>
				<span class='move'>
					<i class='icon-move'></i>
				</span>
			</div>
			<div class='hover-bottom'>
				<a href='/files/products/<?php echo $image['Image']['image']; ?>'>View</a>
				<a href="/images/order_image/<?php echo $product['Product']['url']; ?>?image_id=<?php echo $image['Image']['id']; ?>&amp;position=0" data-confirm="Make this the cover image?" data-method="post" rel="nofollow">Cover</a>
				<a href="/images/delete/<?php echo $product['Product']['url']; ?>?image_id=<?php echo $image['Image']['id']; ?>" data-confirm="Are you sure you want to delete this image?" data-method="delete" rel="nofollow">Delete</a>
			</div>
		</div>
	</div>
</li>