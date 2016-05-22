function mediaPicker(pickerid) {
	var custom_uploader;
	var row_id 
    //e.preventDefault();
	row_id = jQuery('#'+pickerid).prev().attr('id');

    //If the uploader object has already been created, reopen the dialog
    if (custom_uploader) {
    	custom_uploader.open();
    	return;
    }

    //Create the media window.
    custom_uploader = wp.media.frames.file_frame = wp.media({
        title: 'Insert Images',
        button: {
            text: 'Insert Images'
        },
		type: 'image',
        multiple: false
    });

    //Insert Media Action. Preview image and insert values to image
	custom_uploader.on('select', function(){
	var selection = custom_uploader.state().get('selection');
		selection.map( function( attachment ) {
			attachment = attachment.toJSON();
			//INSERT THE SRC IN INPUT FIELD
			jQuery('#' + row_id).val(""+attachment.url+"").trigger('change');
				//APPEND THE PREVIEW IMAGE
				jQuery('#' + row_id).parent().find('.media-picker-preview, .media-picker-remove').remove();
				if(attachment.sizes.medium){
					jQuery('#' + row_id).parent().prepend('<img class="media-picker-preview" src="'+attachment.sizes.medium.url+'" /><span class="media-picker-remove">X</span>');
				}else{
					jQuery('#' + row_id).parent().prepend('<img class="media-picker-preview" src="'+attachment.url+'" /><span class="media-picker-remove">X</span>');
				}

		});
		jQuery(".media-picker-remove").on('click',function(e) {
			jQuery(this).parent().find('.media-picker').val('').trigger('change');
			jQuery(this).parent().find('.media-picker-preview, .media-picker-remove').remove();
		});
	});
    //OPEN THE MEDIA WINDOW
    custom_uploader.open();

}   

jQuery(document).on( 'ready widget-updated widget-added', function() {
	
	//jQuery(".media-picker-remove").unbind( "click" );
	jQuery(".media-picker-remove").on('click',function(e) {
		jQuery(this).parent().find('.media-picker').val('').trigger('change');
		jQuery(this).parent().find('.media-picker-preview, .media-picker-remove').remove();
	});	 

});