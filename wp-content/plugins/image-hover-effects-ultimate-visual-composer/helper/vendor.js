jQuery(".oxilab-tabs-ul li:first").addClass("active");
jQuery(".oxilab-tabs-content-tabs:first").addClass("active");
jQuery(".oxilab-tabs-ul li").click(function () {
    jQuery(".oxilab-tabs-ul li").removeClass("active");
    jQuery(this).toggleClass("active");
    jQuery(".oxilab-tabs-content-tabs").removeClass("active");
    var activeTab = jQuery(this).attr("ref");
    jQuery(activeTab).addClass("active");
});
jQuery("[data-toggle=\"tooltip\"]").tooltip();
jQuery("#oxilab-preview-data-background").on("change", function () {
    jQuery("<style type=\"text/css\"> #oxilab-preview-data{ background-color:" + jQuery("#oxilab-preview-data-background").val() + ";} </style>").appendTo("#oxilab-preview-data");
});

jQuery(".oxilab-vendor-color").on("change", function () {
    var type = jQuery(this).attr('oxiexporttype');
    var exportid = jQuery(this).attr('oxiexportid');
    if (type !== '' && exportid !== '') {
        jQuery("<style type='text/css'> " + exportid + "{" + type + ": " + jQuery(this).val() + ";} </style>").appendTo("#oxilab-preview-data");
    }
});
jQuery("#oxilab-flip-type").on("change", function () {
    jQuery(".oxilab-flip-box-flip").removeClass("oxilab-flip-box-flip-top-to-bottom");
    jQuery(".oxilab-flip-box-flip").removeClass("oxilab-flip-box-flip-left-to-right");
    jQuery(".oxilab-flip-box-flip").removeClass("oxilab-flip-box-flip-bottom-to-top");
    jQuery(".oxilab-flip-box-flip").removeClass("oxilab-flip-box-flip-right-to-left");
    jQuery(".oxilab-flip-box-flip").addClass(jQuery(this).val());
});
jQuery("#oxilab-flip-effects").on("change", function () {
    jQuery(".oxilab-flip-box-style-data").removeClass("easing_easeInOutExpo");
    jQuery(".oxilab-flip-box-style-data").removeClass("easing_easeInOutCirc");
    jQuery(".oxilab-flip-box-style-data").removeClass("easing_easeOutBack");
    jQuery(".oxilab-flip-box-style-data").addClass(jQuery(this).val());
});
jQuery(".oxilab-admin-font").fontselect();
jQuery('#oxilab-admin-add-new-item').on('click', function () {
    jQuery("#oxilab-flip-box-add-new-data").modal("show");
    jQuery("#item-id").val('');
});

jQuery('#oxilab-drag-and-drop').on('click', function () {
    jQuery("#oxilab-drag-and-drop-file").modal("show");
    jQuery("#oxilab-drag-saving").slideUp();

});

setTimeout(function () {
    jQuery('#oxilab-drag-drop').sortable({
        axis: 'y',
        opacity: 0.7,

    });
}, 500);


jQuery(".oxilab-alert-change").on("change", function () {
    var data = "<strong>" + jQuery(this).attr('oxilab-alert') + " </strong> will works after saved data";
    jQuery.bootstrapGrowl(data, {});
});
