jQuery(function () {
    jQuery("#oxilab-drag-and-drop-submit").submit(function (e) {
        var list_sortable = jQuery('#oxilab-drag-drop').sortable('toArray').toString();
        var security = jQuery('#oxilab-flipbox-ajax-nonce').val();        
        jQuery.post({
            url: oxilab_flipbox_drag_drop_ajax.ajaxurl,
            beforeSend: function () {
                jQuery("#oxilab-drag-saving").slideDown();
                jQuery("#oxilab-drag-drop").slideUp();
                jQuery("#oxilab-flipbox-drag-close").slideUp();
                jQuery('#oxilab-flipbox-drag-submit').val('Saving...');
            },
            data: {
                action: 'oxilab_flipbox_admin_ajax_data',
                list_order: list_sortable,
                security: security
            },
            success: function () {
                setTimeout(function () {
                    location.reload();
                }, 500);
            }
        });
        e.preventDefault();
        return false;
    });
});
  