/*
 Requires the following elements, somewhere inside a parent element WITH CLASS .image-select-parent
 input[hidden].image-id-input
 img
 element.select-image
 element.remove-image

 There is a helper that you just pass a label, input name, and id and the rest is taken care of for you. Use this.
 */
(function($, wp){
	var $body = $('body');

	// Media uploader
	$body.on( 'click', '.select-image', function(e) {
		var $this = $(this),
			$parent = $this.parents('.image-select-parent').first(),
			$image = $parent.find('img'),
			$field = $parent.find('.image-id-input'),
			frame;

		e.preventDefault();

		// Create the media frame.
		frame = wp.media.frames.chooseImage = wp.media({
			// Set the title of the modal.
			title: 'Choose an Image',

			// Tell the modal to show only images.
			library: {
				type: 'image'
			},

			// Customize the submit button.
			button: {
				// Set the text of the button.
				text: 'Select Image'
			}
		});

		// When an image is selected, run a callback.
		frame.on( 'select', function() {
			// Grab the selected attachment.
			var attachment = frame.state().get('selection').first(),
				sizes = attachment.get('sizes'),
				imageUrl = attachment.get('url');

			// Use thumbnail size if available for preview
			if ( "undefined" !== typeof sizes.thumbnail ) {
				imageUrl = sizes.thumbnail.url;
			}

			// set the hidden input's value
			$field.attr('value', attachment.id);

			// Show the image in the placeholder
			$image.attr('src', imageUrl);
		});

		frame.open();
	});

	$body.on( 'click', '.remove-image', function(e) {
		var $this = $(this),
			$parent = $this.parents('.image-select-parent').first(),
			$image = $parent.find('img'),
			$field = $parent.find('.image-id-input');

		e.preventDefault();

		$image.attr('src', '');
		$field.attr('value', '');
	});
})(jQuery, wp);
