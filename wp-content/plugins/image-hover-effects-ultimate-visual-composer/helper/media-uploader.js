
jQuery(document).ready(function ($) {
    var custom_uploader;
    jQuery('#flip-box-image-upload-button-01').click(function (e) {
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: true
        });
        custom_uploader.on('select', function () {
            console.log(custom_uploader.state().get('selection').toJSON());
            attachment = custom_uploader.state().get('selection').first().toJSON();
            jQuery('#flip-box-image-upload-url-01').val(attachment.url);
                       
            jQuery("#oxilab-flip-box-add-new-data").css({
                "overflow-x": "hidden",
                "overflow-y": "auto"

            });
            jQuery("body").css({
                "overflow" : "hidden"
            });
          
        });
        custom_uploader.open();
    });
});


jQuery(document).ready(function ($) {
    var custom_uploader;
    jQuery('#flip-box-image-upload-button-02').click(function (e) {
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: true
        });
        custom_uploader.on('select', function () {
            console.log(custom_uploader.state().get('selection').toJSON());
            attachment = custom_uploader.state().get('selection').first().toJSON();
            jQuery('#flip-box-image-upload-url-02').val(attachment.url);
                       
            jQuery("#oxilab-flip-box-add-new-data").css({
                "overflow-x": "hidden",
                "overflow-y": "auto"

            });
            jQuery("body").css({
                "overflow" : "hidden"
            });
          
        });
        custom_uploader.open();
    });
});