<?php

define('TOUR_UPLOAD_DIR', WWW_ROOT . 'files/products/');
App::uses('AttachmentBehavior', 'Uploader.Model/Behavior');

class Image extends AppModel
{
	/**
	 * Standard validation behaviour
	 */
	public $belongsTo = 'Product';
	
	//var $useTable = false;
	
	public $actsAs = array(
		'Uploader.Attachment' => array(
			'image' => array(
				'nameCallback' => 'formateName',
				'overwrite' => true,
				'allowEmpty' => false,
				'stopSave' => true,
				'defaultPath' => 'img/user.png',
				'uploadDir' => TOUR_UPLOAD_DIR,
				// 'transport' => array(
					// 'class' => AttachmentBehavior::S3,
					// 'accessKey' => 'AKIAJZD4RWTVBAXBK42Q',
					// 'secretKey' => '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',
					// 'bucket' => 'futuresecure',
					// 'folder' => 'avatars/',
					// 'region' => Aws\Common\Enum\Region::US_EAST_1,
					// 'acl' => Aws\S3\Enum\CannedAcl::BUCKET_OWNER_FULL_CONTROL,
				// ),
				'transforms' => array(
					'imageSmall' => array(
						'method' => AttachmentBehavior::CROP, // or crop
						//'append' => '-small',
						'width' => 100,
						'height' => 100
					),
					// 'imageMedium' => array(
						// 'method' => 'resize',
						// 'append' => '-medium',
						// 'width' => 800,
						// 'height' => 600,
						// 'aspect' => false
					// )
				),
				'metaColumns' => array(
					'ext' => 'extension',
					'type' => 'type',
					'size' => 'size'
				)
			)
		)
	);

	var $validate = array(
		'user_id' => array(
		),
		'extension' => array(
			'rule' => array('inList', array('gif', 'jpg', 'jpeg', 'png')),
			'message' => 'Only gif, jpg and jpeg images are allowed!'
		),
		'type' => array(
		),
		'size' => array(
		),
	);
	
	public function formateName($name, $file) {
		return uniqid();
	}
}